<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\showController;
use App\Http\Controllers\leaveControlls;

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
    Route::post('/login', [showController::class, 'logInAuth'])->name('login.url');
});

Route::middleware('jwt')->group(function () {
    Route::middleware('member.role')->group(function(){
        Route::get('/member', [showController::class, 'showMemberData'])->name('member.dashboard');
        Route::post('/punchStatus', [showController::class, 'punchStatus'])->name('punch.status');
        Route::get('/emloyees-leaves', [leaveControlls::class, 'leaveEmpView'])->name('leave.dashboard');
        Route::post('/emloyees-leaves', [leaveControlls::class, 'leaveEmpControll'])->name('leave.dashboard.controll');
        Route::post('/select', [leaveControlls::class, 'memberLeaveCount'])->name('select.val');
    });
});
