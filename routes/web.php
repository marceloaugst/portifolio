<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Rotas públicas
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas do painel administrativo (protegidas por autenticação)
Route::middleware('auth')->group(function () {
   Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
   Route::put('/admin/update', [AdminController::class, 'updatePortfolio'])->name('admin.update');
});
