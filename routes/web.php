<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Thesis\ThesisController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Profile\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/thesis', [ThesisController::class, 'index'])->name('thesis');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->middleware('auth')->name('profile.update');
Route::post('/upload-profile', [ProfileController::class, 'upload'])->middleware('auth')->name('profile.upload');