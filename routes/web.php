<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HomeQuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RoleController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/quiz', [HomeQuizController::class, 'index'])->name('quiz.view');

// Auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerStore'])->name('register.store');


//SECTION - Dashboard 
Route::resource('dashboard/quiz', QuizController::class);
Route::resource('dashboard/role', RoleController::class);
Route::resource('dashboard/category', CategoryController::class);
Route::resource('dashboard/question', QuestionController::class);
Route::resource('dashboard/option', OptionController::class);
