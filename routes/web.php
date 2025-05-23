<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Component\Auth\Login;
use App\Livewire\Component\Task\ListTasks;
use App\Livewire\Component\User\ListUsers;


Route::get('/', Login::class)->name('login');
Route::middleware('auth')->group(function () {
    Route::get('/tasks', ListTasks::class)->middleware('roles:admin,employee')->name('tasks');
    Route::get('/users', ListUsers::class)->middleware('roles:admin')->name('users');
});
