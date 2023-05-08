<?php

use Illuminate\Support\Facades\Route;

Route::get('/protected', function () {
    return response()->json(auth()->user());
});

Route::middleware(['can:just:testing'])->get('/scope', function () {
    return response()->json(auth()->user());
});

Route::get('/', function () {
    return response()->json(auth()->user());
});
