<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ExplorerController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\TradeController;
use Illuminate\Support\Facades\Route;

//login e registro
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//trade
Route::post('/trade', [TradeController::class, 'trade']);

//rotas protegidas...
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/explorers/me', [ExplorerController::class, 'update']);
    Route::patch('/explorers/me', [ExplorerController::class, 'update']);
    Route::get('/explorers/me', [ExplorerController::class, 'show']);
    Route::get('/explorers/history', [ExplorerController::class, 'history']);;
    Route::get('/reports', [ItemController::class, 'show']);
    Route::post('/items', [ItemController::class, 'store']);
});
