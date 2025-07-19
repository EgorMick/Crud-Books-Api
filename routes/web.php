<?php

use App\Jobs\SendGmailJob;
use App\Notifications\WelcomeBackHome;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
