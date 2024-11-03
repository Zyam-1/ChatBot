<?php

use App\Http\Middleware\EnsureUserLoggedIn;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUp;
use App\Http\Controllers\Login;
use App\Http\Controllers\Home;

Route::get( '/', function () {
    return redirect()->route('signup');
});



Route::get("/SignUp", [SignUp::class, 'display'])->name("signup");
Route::get("/login",[Login::class, 'login'])->name('login');
Route::get("/logout", [Login::class, 'logout'])->name('logout');
Route::post("/authenticate",[Login::class, 'authenticate'])->name('authenticate');

Route::middleware([EnsureUserLoggedIn::class])->group(function(){
    Route::get("/home",[Home::class, 'home'])->name('home');

});

