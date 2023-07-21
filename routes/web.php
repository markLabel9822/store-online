<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\SocialiteLoginController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/login/{provider}', [SocialiteLoginController::class, 'redirectToProvider']);
Route::get('/login/{provider}/callback', [SocialiteLoginController::class, 'handleProviderCallback']);
