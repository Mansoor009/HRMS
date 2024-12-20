<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\leaveCountModel;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class showController extends Controller
{

    public function attendance($month)
    {
        $userId = Auth::id();
        $punchData = Attendance::select(
            'users.id',
            'users.user_name',
            DB::raw('DATE(attendances.created_at) as present_date'),
            DB::raw('MIN(CASE WHEN attendances.punch_status = 1 THEN attendances.created_at END) AS first_punch'),
            DB::raw('MAX(CASE WHEN attendances.punch_status = 0 THEN attendances.created_at END) AS last_punch'),
            DB::raw('TIMEDIFF(MAX(CASE WHEN attendances.punch_status = 0 THEN attendances.created_at END), MIN(CASE WHEN attendances.punch_status = 1 THEN attendances.created_at END)) AS time_difference')
        )
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->where('user_id',$userId)
            ->whereMonth('attendances.created_at', '=', $month)
            ->groupBy('users.id', 'users.user_name', 'present_date')
            ->get();

        return $punchData;
    }

    public function Timer($punch)
    {
        $userId = Auth::id();
        $timerRecords = DB::table('attendances')
            ->select('created_at', 'punch_status')
            ->whereDate('created_at', now()->toDateString())
            ->where('user_id', $userId)
            ->get();

        $timeDifference = [];

        foreach ($timerRecords as $record) {
            $punchStatus = $record->punch_status;
            if ($punchStatus == 1) {
                $punchIn = $record->created_at;
            } else {
                if (isset($punchIn)) {
                    if ($punchStatus == 0) {
                        $punchOut = $record->created_at;
                    }
                    $difference = Carbon::parse($punchOut)->diff(Carbon::parse($punchIn));
                    $timeDifference[] = $difference;
                    // print_r($timeDifference);
                    unset($punchIn);
                }
            }
        }
        if ($punch == 1 && isset($punch)) {
            $difference = Carbon::parse(now())->diff(Carbon::parse($punchIn));
            $timeDifference[] = $difference;
            // dd($timeDifference);
        }
        $begin = Carbon::createFromFormat('H:i:s', '00:00:00');

        foreach ($timeDifference as $element) {
            $begin = $begin->addHours($element->format('%h'))
                ->addMinutes($element->format('%i'))
                ->addSeconds($element->format('%s'));
        }

        return $begin;
    }

    //main page
    public function showAdminData()
    {
        $users = User::all();
        $userId = Auth::id();
        if (!$userId) {
            abort(404, 'User Id Not Found!');
        } else {
            return view('admin.dashboard', ['users' => $users]);
        }
    }
    public function showMemberData()
    {
        $users = User::all();
        $userId = Auth::id();
        if (!$userId) {
            abort(404, 'User Id Not Found!');
        } else {
            $attendance  = DB::table('attendances')
                ->select('punch_status', 'created_at')
                ->whereDate('created_at', now()->toDateString())
                ->where('user_id', $userId)
                ->get();

            $punch = Attendance::select('punch_status')
                ->where('user_id', $userId)
                ->orderBy('id', 'DESC')
                ->pluck('punch_status')
                ->first();

            $lastPunchOut = DB::table('attendances')
                ->select('created_at')
                ->where('user_id', $userId)
                ->where('punch_status', 0)
                ->orderBy('id', 'DESC')
                ->pluck('created_at')
                ->first();

            $firstPunchIn = DB::table('attendances')
                ->select('created_at')
                ->where('punch_status', 1)
                ->whereDate('created_at', now()->toDateString())
                ->where('user_id', $userId)
                ->orderBy('id', 'asc')
                ->value('created_at');

            $begin = $this->Timer($punch);

            $daily = $this->attendance(1);
            return view('member.member_dash', [
                'users' => $users, 'attendance' => $attendance,
                'punch' => $punch,
                'lastPunchOut' => $lastPunchOut,
                'firstPunchIn' => $firstPunchIn,
                'begin' => $begin->format('H:i:s'),
                'begin_hours' => $begin->format('H'),
                'begin_mins' => $begin->format('i'),
                'begin_seconds' => $begin->format('s'),
                'list' => $daily
            ]);
        }
    }

    //register view
    public function registerView()
    {
        return view('register');
    }

    //register backend code
    public function registerControl(Request $request)
    {
        if ($request->user_id) {
            $update = User::find($request->user_id);
            if (!$update) {
                abort(404);
            } else {
                $update->update([
                    'user_name' => $request->user_name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number
                ]);
            }
            response(['status' => true]);
        } else {
            $request->validate([
                'user_name' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|unique:users|min:5',
                'mobile_number' => 'required|numeric|digits:10'
            ]);

            $user = User::create([
                'user_name' => $request->user_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile_number' => $request->mobile_number,
                'role' => 'member'
            ]);
            $lastId = $user->id;
            $leave_count = leaveCountModel::create([
                'user_id' => $lastId,
                'sick_leave' => 6,
                'paid_leave' => 12,
                'festive_leave' => 6
            ]);
            if (!$user) {
                return response(['error' => 'Registration Failed Please Try Again']);
            } else {
                return response(['status' => true, 'leave_count' => $leave_count]);
            }
        }
    }

    //login view
    public function logInView()
    {
        return view('login');
    }

    //login backend code
    public function logInAuth(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->status == 0) {
                return response(['message' => 'Your Account Is De-Activated', 'status' => 'denied']);
            } else if ($user->role == 'member' && $user->status == 1) {
                if(isset($request->fcm_token)){
                    User::where('id', $user->id)->update(['fcm_token' => $request->fcm_token]);
                }
                $token = JWTAuth::fromUser($user);
                return response(['message' => 'Member Succesfully Logging in', 'status' => 'member','token' => $token]);
            } else if ($user->role == 'admin' && $user->status == 1) {
                if(isset($request->fcm_token)){
                    User::where('id', $user->id)->update(['fcm_token' => $request->fcm_token]);
                }
                $token = JWTAuth::fromUser($user);
                return response(['message' => 'Admin Succesfully Logging in', 'status' => 'admin','token' => $token]);
            }
        } else {
            return response(['Message' => 'Wrong Credentials', 'status' => false]);
        }
    }

    //logout code
    public function logOut(Session $session)
    {
        // JWTAuth::parseToken()->invalidate(true);
        $session->flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function deleteData($id)
    {
        if (!$id) {
            return response(['status' => false, 'message' => 'Id has not Been Sent Cant Remove Data.']);
        } else {
            $delete = User::where('id', $id)->delete();
            return response(['id' => $id, 'status' => 'Data Removed Succesfully.']);
        }
    }

    public function getData($id)
    {
        if (!$id) {
            return response(['status' => false, 'message' => 'Id has not Been Sent']);
        } else {
            $update = User::where('id', $id)->get();
            return response(['data' => $update]);
        }
    }

    public function statusChange(Request $request)
    {
        if (!$request->id) {
            return response(['status' => false, 'message' => 'Id has not Been Sent']);
        } else {
            $status = User::where('id', $request->id)->update(['status' => $request->status]);
            return response(['status' => $request->status, 'message' => $request->status == 1 ? 'Activated Succesfully' : 'De-Activated Succesfully']);
        }
    }

    public function punchStatus(Request $request)
    {
        $userId = Auth::id();
        $fields = [
            'user_id' => $userId,
            'punch_status' => $request->status,
            'created_at' => now()
        ];
        $lastId = Attendance::where('user_id', $userId)
            ->orderBy('id', 'DESC')
            ->pluck('punch_status')
            ->first();
        if ($lastId == $fields['punch_status']) {
            return response(['status' => false, 'message' => 'Already Punched In']);
        } else {
            Attendance::create($fields);

            $result = DB::table('attendances')
                ->where('user_id', $userId)
                ->whereDate('created_at', now()->toDateString())
                ->get();

            $punch = Attendance::select('punch_status')
                ->where('user_id', $userId)
                ->orderBy('id', 'DESC')
                ->pluck('punch_status')
                ->first();

            $begin = $this->Timer($punch);



            return response([
                'status' => true, 'punch' => $request->status,
                'attendance' => $result,
                'begin' => $begin->format('h:i:s'),
                'begin_hours' => $begin->format('H'),
                'begin_mins' => $begin->format('i'),
                'begin_seconds' => $begin->format('s'),
            ]);
        }
    }

    public function table(){
        return view('admin.test');
    }
}
