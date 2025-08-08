<?php

use App\Livewire\Auth\Login;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('password/request', Login::class)->name('password.request');
    Route::get('register', Login::class)->name('register');
});
