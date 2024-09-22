<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// Rotas acessíveis somente quando o usuario nao estiver logado
Route::middleware([CheckIsNotLogged::class])->group(function() {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('loginsubmit', [AuthController::class, 'loginSubmit']);
});

// Rotas acessíveis somente quando o usuario estiver logado
Route::middleware([CheckIsLogged::class])->group(function(){
    Route::get('/', [MainController::class, 'index']);
    Route::get('/newnote', [MainController::class, 'newNote']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

