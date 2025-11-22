<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\showController;
use App\Http\Controllers\leaveControlls;
use App\Http\Controllers\SendNotification;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['api'],function(){
    Route::post('/login', [showController::class, 'logInAuth']);
});

Route::middleware('jwt')->group(function () {
    Route::middleware('member.role')->group(function(){
        Route::get('/member', [showController::class, 'showMemberData']);
        Route::post('/punchStatus', [showController::class, 'punchStatus']);
        Route::get('emloyees-leaves', [leaveControlls::class, 'leaveEmpView']);
        Route::post('/emloyees-leaves', [leaveControlls::class, 'leaveEmpControll']);
        Route::post('/select', [leaveControlls::class, 'memberLeaveCount']);
        Route::get('/send-notification', [SendNotification::class, 'sendNotification']);
    });
});
