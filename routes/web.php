<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',function()
{
    return view('login');
})->name('login');

Route::post('/register' , [Authentication::class,'register']);

Route::post('/empLogin' , [Authentication::class,'login']);