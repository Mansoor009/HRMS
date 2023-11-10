<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\showController;

Route::get('/admin',[showController::class,'showAdminData'])->name('admin.dashboard');
Route::get('/member',[showController::class,'showMemberData'])->name('member.dashboard');
Route::get('/register',[showController::class,'registerView'])->name('register');
Route::post('/register',[showController::class,'registerControl'])->name('register.url');
Route::get('/login',[showController::class,'logInView'])->name('login');
Route::post('/login',[showController::class,'logInAuth'])->name('login.url');
Route::get('/logout',[showController::class,'logOut'])->name('logut');
Route::get('/forget_password',[showController::class,'ForgetPasswordView'])->name('forgotPassword');
Route::post('/forget_password',[showController::class,'ForgetPasswordControl'])->name('forgot.password');
Route::get('/reset_password/{token}/{email}',[showController::class,'resetPasswordView'])->name('reset.password');
Route::post('/reset_password',[showController::class,'resetPasswordControl'])->name('reset.password.post');
Route::post('/delete/{id}',[showController::class,'deleteData'])->name('remove.data');
Route::get('/edit/{id}',[showController::class,'getData'])->name('edit.data');
Route::post('/status',[showController::class,'statusChange'])->name('update.status');
