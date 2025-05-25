<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Thesis\ThesisController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/thesis', [ThesisController::class, 'index'])->name('thesis');