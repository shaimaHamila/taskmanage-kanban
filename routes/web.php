<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Component\Auth\Login;
use App\Livewire\Component\Task\ListTasks;
use App\Livewire\Component\User\ListUsers;


Route::get('/', Login::class)->name('login');
Route::get('/tasks', ListTasks::class)->middleware('auth')->name('tasks');
Route::get('/users', ListUsers::class)->middleware('auth')->name('users');
