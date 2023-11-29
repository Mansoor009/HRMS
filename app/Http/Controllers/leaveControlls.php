<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\leaveCountModel;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class leaveControlls extends Controller
{
    public function leaveEmpView()
    {
        $userId = Auth::id();
        $leave_count = leaveCountModel::where('user_id', $userId)->get();
        return view('member.leave_dash', ['leave_count' => $leave_count, 'sick' => SICK_LEAVE, 'paid' => PAID_LEAVE, 'festive' => FESTIVE_LEAVE]);
    }

    public function leaveEmpControll(Request $request)
    {
        dd($request);
        return response(['response' => $request]);
    }
}
