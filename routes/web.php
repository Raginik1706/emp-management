<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;

Route::get('/',[Authentication::class , 'registerView']);

Route::get('/login',function()
{
    return view('login');
})->name('login');

Route::post('/register' , [Authentication::class,'register']);

Route::post('/empLogin' , [Authentication::class,'login']);

Route::get('/emp-profile' , [Authentication::class,'empProfile'])->name('profile');

Route::get('/adminDashboard' , [Authentication::class,'displayAdminDashboard'])->name('admin_dashboard');

Route::get('/admin-login',function()
{
    return view('admin');
})->name('admin');

Route::get('/logout', [Authentication::class , 'logout'])->name('logout');

Route::post('/employee/update', [Authentication::class, 'updateProfile'])->name('employee.update');


