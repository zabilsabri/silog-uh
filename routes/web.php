<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Thesis\ThesisController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Student\StudentController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/thesis', [ThesisController::class, 'index'])->name('thesis');
Route::get('/thesis/{id}', [ThesisController::class, 'detail'])->name('thesis.detail');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/profile', [ProfileController::class, 'index'])->middleware('auth')->name('profile');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->middleware('auth')->name('profile.update');
Route::post('/upload-profile', [ProfileController::class, 'upload'])->middleware('auth')->name('profile.upload');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/', [HomeController::class, 'adminIndex'])->name('home-admin');
    Route::get('/students', [StudentController::class, 'index'])->name('students.admin');
    Route::get('/students/{id}', [StudentController::class, 'detail'])->name('students.detail.admin');

    Route::Delete('/students/delete/{id}', [StudentController::class, 'delete'])->name('students.delete.admin');
    Route::post('/students/add', [StudentController::class, 'add'])->name('students.create.admin');

});