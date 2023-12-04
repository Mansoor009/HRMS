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

            while ($start <= $end) {
                if ($start->format('N') < 7) {
                    $days++;
                }
                $start->add($collect);
            }
            if ($days <= $balance) {
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
            $fetch = leaveRecordModel::select('leave_type', 'no_of_days')->where('id', $request->id)->get();
            $leave_type = $fetch->pluck('leave_type')->first();
            $no_of_days = $fetch->pluck('no_of_days')->first();

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

    public function holidayView(){
        return view('admin.holidays_list');
    }

    public function holidayControll(Request $request){
         
    }
}
