<?php

use App\Livewire\ListUsers;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/users', ListUsers::class)->name('users')->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
