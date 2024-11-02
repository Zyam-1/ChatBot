<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\Login;

Route::get( '/', function () {
    return redirect()->route('signup');
});



Route::get("/SignUp", [SignUp::class, 'display'])->name("signup");
Route::get("/login",[Login::class, 'login'])->name('login');
Route::get("/home",[Login::class, 'login'])->name('home');
