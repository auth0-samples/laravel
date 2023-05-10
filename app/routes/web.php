<?php

declare(strict_types=1);

use Auth0\Laravel\Http\Controller\Stateful\Callback;
use Auth0\Laravel\Http\Controller\Stateful\Login;
use Auth0\Laravel\Http\Controller\Stateful\Logout;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth0 Utility Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/login', Login::class)->name('login');
Route::get('/callback', Callback::class)->name('auth0.callback');
Route::get('/logout', Logout::class)->name('logout');

/*
|--------------------------------------------------------------------------
| Example Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return view('auth0.user');
    }

    return view('auth0/guest');
})->middleware(['auth0.authenticate.optional']);

// Require an authenticated session to access this route.
Route::get('/required', function () {
    return view('auth0.user');
})->middleware(['auth0.authenticate']);
