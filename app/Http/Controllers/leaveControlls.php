<?php
// SELECT u.user_name, DATE(a.created_at) AS punch_date, MIN(a.created_at) AS first_punch,a.punch_status FROM attendances a INNER JOIN users u ON a.user_id = u.id WHERE a.punch_status = 1 GROUP BY a.user_id, DATE(a.created_at);
namespace App\Http\Controllers;

use App\Models\bankHolidayModel;
use App\Models\leaveCountModel;
use App\Models\leaveRecordModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;
use App\Models\Attendance;
use App\Models\User;

class leaveControlls extends Controller
{
    public function attendance($month)
    {
        // $firstPunch = Attendance::select('users.id', 'users.user_name', DB::raw('DATE(attendances.created_at) as punch_date'),DB::raw('MIN(attendances.created_at) AS first_punch'))
        // ->join('users', 'attendances.user_id', '=', 'users.id')
        // ->where('attendances.punch_status', 1)
        // ->whereMonth('attendances.created_at', '=', $month) // Replace '12' with the desired month
        // ->groupBy('users.id', 'users.user_name', 'punch_date', 'attendances.punch_status')
        // ->get();

        // $lastPunch = Attendance::select('users.id', 'users.user_name', DB::raw('DATE(attendances.created_at) as punch_date'),DB::raw('MAX(attendances.created_at) AS last_punch'))
        // ->join('users', 'attendances.user_id', '=', 'users.id')
        // ->where('attendances.punch_status', 0)
        // ->whereMonth('attendances.created_at', '=', $month) // Replace '12' with the desired month
        // ->groupBy('users.id', 'users.user_name', 'punch_date', 'attendances.punch_status')
        // ->get();

        $punchData = Attendance::select(
            'users.id',
            'users.user_name',
            DB::raw('DATE(attendances.created_at) as present_date'),
            DB::raw('MIN(CASE WHEN attendances.punch_status = 1 THEN attendances.created_at END) AS first_punch'),
            DB::raw('MAX(CASE WHEN attendances.punch_status = 0 THEN attendances.created_at END) AS last_punch'),
            DB::raw('TIMEDIFF(MAX(CASE WHEN attendances.punch_status = 0 THEN attendances.created_at END), MIN(CASE WHEN attendances.punch_status = 1 THEN attendances.created_at END)) AS time_difference')
        )
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->whereMonth('attendances.created_at', '=', $month)
            ->groupBy('users.id', 'users.user_name', 'present_date')
            ->orderBy('attendances.user_id')
            ->get();

        // return ['firstPunch' => $firstPunch, 'lastPunch' => $lastPunch];
        return $punchData;
    }
    public function leaveEmpView()
    {
        $userId = Auth::id();
        $leave_count = leaveCountModel::where('user_id', $userId)->get();
        $leave_record = leaveRecordModel::where('user_id', $userId)->get();
        // dd($leave_count);
        return view('member.leave_dash', [
            'leave_count' => $leave_count,
            'sick' => SICK_LEAVE,
            'paid' => PAID_LEAVE,
            'festive' => FESTIVE_LEAVE,
            'leave_records' => $leave_record,
            'id' => $userId
        ]);
    }

    public function leaveEmpControll(Request $request)
    {
        $userId = Auth::id();
        if (!$userId) {
            abort(404, 'User Id Not Found!');
        } else {
            switch ($request->select) {
                case SICK_LEAVE:
                    $col = 'sick_leave';
                    break;
                case PAID_LEAVE:
                    $col = 'paid_leave';
                    break;
                case FESTIVE_LEAVE:
                    $col = 'festive_leave';
                    break;
            }
            $bal = leaveCountModel::select($col)->where('user_id', $userId)->get();
            $balance = $bal->pluck($col)->first();

            $collect = new DateInterval('P1D');
            $days = 0;
            $fdate = $request->from;
            $tdate = $request->to;
            $start = Carbon::parse($fdate);
            $end =  Carbon::parse($tdate);
            $holidayCount = bankHolidayModel::whereBetween('date', [$start, $end])
                ->where('status', 1)
                ->count();
            while ($start <= $end) {
                if ($start->format('N') < 7) {
                    $days++;
                }
                $start->add($collect);
            }

            $total = $days - $holidayCount;

            if ($total <= $balance) {
                $leave_record = leaveRecordModel::create([
                    'user_id' => $userId,
                    'title' => $request->title,
                    'from_leave' => $request->from,
                    'to_leave' => $request->to,
                    'description' => $request->desc,
                    'leave_type' => $request->select,
                    'no_of_days' => $total
                ]);
                return response(['status' => true, 'data' => $leave_record]);
            } else {
                $error = 'Your Leave Balance is Exceeding';
                return response(['status' => false, 'data' => $error]);
            }
        }
    }

    public function adminLeaveView()
    {
        $leave_record = leaveRecordModel::all();
        return view('admin.leave_admin_dash', ['leave_records' => $leave_record]);
    }

    public function adminLeaveControll(Request $request)
    {
        if (isset($request->val)) {
            $val = leaveRecordModel::where('id', $request->id)->update(['status' => $request->val]);
        } else {
            echo 'Reason is not posted Or Your leave Is Approved';
        }

        if (isset($request->reason)) {
            $reason = leaveRecordModel::where('id', $request->id)->update(['reject_reason' => $request->reason]);
        } else {
            echo 'Value is null';
        }

        if ($request->val == 1) {
            $fetch = leaveRecordModel::select('leave_type', 'no_of_days')->where('id', $request->id)->first();
            $leave_type = $fetch->leave_type;
            $no_of_days = $fetch->no_of_days;

            switch ($leave_type) {
                case SICK_LEAVE:
                    $col = 'sick_leave';
                    break;
                case PAID_LEAVE:
                    $col = 'paid_leave';
                    break;
                case FESTIVE_LEAVE:
                    $col = 'festive_leave';
                    break;
            }

            $deduct = leaveCountModel::where('user_id', $request->user_id)->update([$col => DB::raw("$col - $no_of_days")]);
        }
        return response(['value' => $request->val]);
    }

    public function memberLeaveCount()
    {
        $userId = Auth::id();
        $account = leaveCountModel::where('user_id', $userId)->get();
        return response(['account' => $account]);
    }

    public function holidayView()
    {
        $list = bankHolidayModel::all();
        return view('admin.holidays_list', ['list' => $list]);
    }

    public function holidayControll(Request $request)
    {
        if ($request->id) {
            $update = bankHolidayModel::find($request->id);
            if (!$update) {
                abort(404);
            } else {
                $update->update([
                    'title' => $request->title,
                    'date' => $request->date,
                ]);
            }
            response(['status' => true]);
        } else {
            $insert = bankHolidayModel::create([
                'title' => $request->title,
                'date' => $request->date,
                'status' => 1
            ]);
            return response(['data' => $insert]);
        }
    }
    public function holidayStatus(Request $request)
    {
        if (!$request->id) {
            return response(['status' => false, 'message' => 'Id has not Been Sent']);
        } else {
            $status = bankHolidayModel::where('id', $request->id)->update(['status' => $request->val]);
            return response(['val' => $request->val]);
        }
    }
    public function holidayEdit($id)
    {
        if (!$id) {
            return response(['status' => false]);
        } else {
            $update = bankHolidayModel::where('id', $id)->get();
            return response(['update' => $update]);
        }
    }

    public function empAttendanceList()
    {

        $detail = User::select('id', 'user_name')->orderBy('id')->get();
        $attendance = $this->attendance(1);
        foreach ($detail as $value) {
            $employee['id'] = $value->id;
            $employee['user_name'] = $value->user_name;
            $attend = [];
            foreach ($attendance as $date) {
                if ($value->id == $date->id) {
                    $attend2['present_day'] = $date->present_date;
                    $attend2['time_difference'] = strtotime($date->time_difference) - strtotime('00:00:00');
                    $attend[] = $attend2;
                }
            }
            $employee['attendance'] = $attend;
            $list[] = $employee;
        }
        // return $list;
        return view('admin.attendance-list', ['list' => $list]);
    }

    public function showTime(Request $request, $id)
    {
        $duration = Attendance::select(
            'user_id',
            DB::raw('TIMEDIFF(MAX(CASE WHEN punch_status = 0 THEN created_at END), MIN(CASE WHEN punch_status = 1 THEN created_at END)) AS time_difference')
        )->where('user_id', $id)
            ->whereDate('created_at', $request->date)
            ->groupBy('user_id')
            ->first();
        return $duration;
    }
}
