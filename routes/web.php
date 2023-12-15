<?php

use App\Http\Controllers\ForgetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\showController;
use App\Http\Controllers\leaveControlls;

Route::controller(showController::class)->group(function () {
    Route::get('/register', 'registerView')->name('register');
    Route::post('/register', 'registerControl')->name('register.url');
    Route::get('/login', 'logInView')->name('login');
    Route::post('/login', 'logInAuth')->name('login.url');
    Route::get('/logout', 'logOut')->name('logut');
});

Route::controller(ForgetController::class)->group(function(){
    Route::get('/forget-password', 'ForgetPasswordView')->name('forgotPassword');
    Route::post('/forget-password', 'ForgetPasswordControl')->name('forgot.password');
    Route::get('/reset-password/{token}/{email}','resetPasswordView')->name('reset.password');
    Route::post('/reset-password','resetPasswordControl')->name('reset.password.post');
});


Route::middleware('auth')->group(function () {
    Route::middleware('admin.role')->group(function () {
        Route::get('/admin', [showController::class, 'showAdminData'])->name('admin.dashboard');
        Route::post('/delete/{id}', [showController::class, 'deleteData'])->name('remove.data');
        Route::get('/edit/{id}', [showController::class, 'getData'])->name('edit.data');
        Route::post('/status', [showController::class, 'statusChange'])->name('update.status');
        Route::get('/admin-leave-dasboard', [leaveControlls::class, 'adminLeaveView'])->name('admin.leave.dashboard');
        Route::post('/admin-leave-dasboard', [leaveControlls::class, 'adminLeaveControll'])->name('admin.leave.controll');
        Route::get('/admin-holidays-list', [leaveControlls::class, 'holidayView'])->name('admin.holiday.view');
        Route::post('/admin-holidays-list', [leaveControlls::class, 'holidayControll'])->name('admin.holiday.controll');
        Route::post('/admin-holidays-status', [leaveControlls::class, 'holidayStatus'])->name('admin.holiday.status');
        Route::get('/admin-holidays-edit/{id}', [leaveControlls::class, 'holidayEdit'])->name('admin.holiday.edit');
        Route::get('/admin-attendance-list', [leaveControlls::class, 'empAttendanceList'])->name('admin.holiday.edit');
    });
    Route::middleware('member.role')->group(function () {
        Route::get('/member', [showController::class, 'showMemberData'])->name('member.dashboard');
        Route::post('/punchStatus', [showController::class, 'punchStatus'])->name('punch.status');
        Route::get('/emloyees-leaves', [leaveControlls::class, 'leaveEmpView'])->name('leave.dashboard');
        Route::post('/emloyees-leaves', [leaveControlls::class, 'leaveEmpControll'])->name('leave.dashboard.controll');
        Route::post('/select', [leaveControlls::class, 'memberLeaveCount'])->name('select.val');
    });
});
