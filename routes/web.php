<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DailyMealController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/daily-meals', [DailyMealController::class, 'index'])->name('daily-meals.index');

    Route::middleware('admin')->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/companies/create', [CompanyController::class, 'create'])->name('companies.create');
        Route::post('/companies', [CompanyController::class, 'store'])->name('companies.store');
        Route::get('/companies/{company}/edit', [CompanyController::class, 'edit'])->name('companies.edit');
        Route::put('/companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/companies/{company}', [CompanyController::class, 'destroy'])->name('companies.destroy');

        Route::get('/daily-meals/create', [DailyMealController::class, 'create'])->name('daily-meals.create');
        Route::post('/daily-meals', [DailyMealController::class, 'store'])->name('daily-meals.store');
        Route::get('/daily-meals/{daily_meal}/edit', [DailyMealController::class, 'edit'])->name('daily-meals.edit');
        Route::put('/daily-meals/{daily_meal}', [DailyMealController::class, 'update'])->name('daily-meals.update');
        Route::delete('/daily-meals/{daily_meal}', [DailyMealController::class, 'destroy'])->name('daily-meals.destroy');
    });
});
