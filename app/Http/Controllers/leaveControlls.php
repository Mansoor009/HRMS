<?php

namespace App\Http\Controllers;

use App\Models\leaveCountModel;
use App\Models\leaveRecordModel;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DateInterval;

class leaveControlls extends Controller
{
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
            $collect = new DateInterval('P1D');
            $days = 0;
            $fdate = $request->from;
            $tdate = $request->to;
            $start = Carbon::parse($fdate);
            $end =  Carbon::parse($tdate);

            while ($start <= $end) {
                if ($start->format('N') < 7) {
                    $days++;
                }
                $start->add($collect);
            }

            $leave_record = leaveRecordModel::create([
                'user_id' => $userId,
                'title' => $request->title,
                'from_leave' => $request->from,
                'to_leave' => $request->to,
                'description' => $request->desc,
                'leave_type' => $request->select,
                'no_of_days' => $days
            ]);

            return response(['status' => true, 'data' => $leave_record]);
        }
    }

    public function adminLeaveView()
    {
        $leave_record = leaveRecordModel::all();
        return view('admin.leave_admin_dash', ['leave_records' => $leave_record]);
    }

    public function adminLeaveControll(Request $request)
    {
        $fetch = leaveRecordModel::select('leave_type','no_of_days')->where('id',$request->id)->orderBy('id','desc')->first();
        dd($fetch);
        $update = leaveRecordModel::where('id', $request->id)
        
            ->update([
                'status' => $request->val,
                'reject_reason' => $request->reason
            ]);
            if ($request->val == 1) {
                $count = leaveCountModel::where('user_id',$request->id)->update(['  ']);
            }

        return response(['value' => $request->val]);
    }

    public function memberLeaveCount()
    {
        $userId = Auth::id();
        $account = leaveCountModel::where('user_id',$userId)->get();
        return response(['account' => $account]);
    }
}
