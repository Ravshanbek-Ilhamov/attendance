<?php

use App\Livewire\AttendanceComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/',AttendanceComponent::class);
