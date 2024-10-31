<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\HomeQuizController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/quiz', [HomeQuizController::class, 'index'])->name('quiz.view');


// Auth
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerStore'])->name('register.store');


Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    // Kerjakan quiz
    Route::get('quiz/leaderboard', [HomeQuizController::class, 'leaderboard'])->name('quiz.leaderboard');
    Route::post('quiz/add-answer', [HomeQuizController::class, 'addAnswer'])->name('add.answer');
    Route::get('quiz/{ulid}/show', [HomeQuizController::class, 'show'])->name('homequiz.show');
    Route::post('quiz/finish', [HomeQuizController::class, 'finishQuiz'])->name('quiz.finish');

    // user profile
    Route::get('/profile/{username}', [UserController::class, 'profile'])->name('user.profile');
    Route::put('/profile/update-picture', [UserController::class, 'updatePicture'])->name('user.update.picture');

    //SECTION - Dashboard 
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('dashboard/quiz', QuizController::class);
        Route::resource('dashboard/role', RoleController::class);
        Route::resource('dashboard/category', CategoryController::class);
        Route::resource('dashboard/question', QuestionController::class);
        Route::resource('dashboard/option', OptionController::class);
        Route::resource('dashboard/answer', AnswerController::class);
        Route::resource('dashboard/result', ResultController::class);



        // Super Admin Only
        Route::resource('dashboard/user', UserController::class)->middleware('isSuperAdmin');
    });
});
