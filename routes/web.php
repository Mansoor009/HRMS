<?php

use App\Http\Controllers\ForgetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\showController;
use App\Http\Controllers\leaveControlls;

Route::controller(showController::class)->group(function () {
    Route::get('/register', 'registerView')->name('register');
    Route::post('/register', 'registerControl')->name('register.url');
    Route::get('/', 'logInView')->name('login');
    Route::post('/login', 'logInAuth')->name('login.url');
    Route::get('/logout', 'logOut')->name('logut');
});

Route::controller(ForgetController::class)->group(function () {
    Route::get('/forget-password', 'ForgetPasswordView')->name('forgotPassword');
    Route::post('/forget-password', 'ForgetPasswordControl')->name('forgot.password');
    Route::get('/reset-password/{token}/{email}', 'resetPasswordView')->name('reset.password');
    Route::post('/reset-password', 'resetPasswordControl')->name('reset.password.post');
});


Route::middleware('auth')->group(function () {
    Route::middleware('admin.role')->group(function () {
        Route::controller(showController::class)->group(function () {
            Route::get('/admin', 'showAdminData')->name('admin.dashboard');
            Route::post('/delete/{id}', 'deleteData')->name('remove.data');
            Route::get('/edit/{id}', 'getData')->name('edit.data');
            Route::post('/status', 'statusChange')->name('update.status');
        });
        Route::controller(leaveControlls::class)->group(function () {
            Route::get('/admin-leave-dasboard', 'adminLeaveView')->name('admin.leave.dashboard');
            Route::post('/admin-leave-dasboard', 'adminLeaveControll')->name('admin.leave.controll');
            Route::get('/admin-holidays-list', 'holidayView')->name('admin.holiday.view');
            Route::post('/admin-holidays-list', 'holidayControll')->name('admin.holiday.controll');
            Route::post('/admin-holidays-status', 'holidayStatus')->name('admin.holiday.status');
            Route::get('/admin-holidays-edit/{id}', 'holidayEdit')->name('admin.holiday.edit');
            Route::get('/admin-attendance-list', 'empAttendanceList')->name('admin.attendance.list');
            Route::get('/admin-emp-duration/{id}', 'showTime')->name('emp.duration');
        });
    });
    Route::middleware('member.role')->group(function () {
        Route::get('/member', [showController::class, 'showMemberData'])->name('member.dashboard');
        Route::post('/punchStatus', [showController::class, 'punchStatus'])->name('punch.status');
        Route::get('/emloyees-leaves', [leaveControlls::class, 'leaveEmpView'])->name('leave.dashboard');
        Route::post('/emloyees-leaves', [leaveControlls::class, 'leaveEmpControll'])->name('leave.dashboard.controll');
        Route::post('/select', [leaveControlls::class, 'memberLeaveCount'])->name('select.val');
    });
});
