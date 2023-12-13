<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\leaveCountModel;
use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth;

class ForgetController extends Controller
{
    public function ForgetPasswordView()
    {
        return view('forget_password');
    }
    //Forgot password backend
    public function ForgetPasswordControl(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(30);

        ResetPassword::create([
            'email' => $request->email,
            'token' => $token
        ]);

        $response  = Mail::send(
            'email.forget_password',
            [
                'token' => $token,
                'email' => $request->email
            ],
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            }
        );

        return response(['Message' => 'Email Sent', 'status' => true]);
        // return  redirect()->to(route('forgotPassword'))->with(['success' => 'Email Send']);
    }

    public function resetPasswordView($token, $email)
    {
        return view('new_password', ['token' => $token, 'email' => $email]);
    }

    public function resetPasswordControl(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users',
            'password' => 'required|confirmed|string|min:6',
            'password_confirmation' => 'required'
        ]);

        $reset = ResetPassword::where('token', $request->token)->get();

        if (!$reset) {
            return response(['message' => 'Invalid', 'status' => false]);
        }
        // DB::table('users')
        //     ->update(['password' => Hash::make($request->password)]);
        User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        return response(['message' => 'Password Changed', 'status' => true]);
    }
}
