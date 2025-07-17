<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::get('/logado', [UserController::class, 'index']);

    Route::apiResource('/produtos', OrdersController::class)->only('index', 'store');
    Route::put('/produtos/{id}', [OrdersController::class, 'update']);
    Route::delete('/produtos/{id}', [OrdersController::class, 'destroy']);
    Route::get('/produtos/{id}', [OrdersController::class, 'find']);

    Route::get('/users', [UserController::class, 'allUsers']);

    Route::get('/perfil', [UserController::class, 'index']);
    Route::put('/perfil/{id}', [UserController::class, 'update']);
    Route::delete('/perfil/{id}', [UserController::class, 'destroy']);

    Route::post('/comprar', [PurchaseController::class, 'purchase']);
});
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'store']);




