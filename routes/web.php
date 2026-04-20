<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FeedbackController::class, 'home'])->name('home');
Route::get('/submit', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/submit', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/complaints', [FeedbackController::class, 'index'])->name('complaints.index');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin', [AdminController::class, 'loginForm'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/update-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
