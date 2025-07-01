<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExplorerController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\TradeController;
use App\Http\Controllers\AuthController;

//login e registro
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//trade
Route::post('/trade', [TradeController::class, 'trade']);

//rotas protegidas...
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/explorers/me', [ExplorerController::class, 'store']);
    Route::put('/explorers/me', [ExplorerController::class, 'updateLocation']);
    Route::patch('/explorers/me', [ExplorerController::class, 'updateLocation']);
    Route::get('/explorers/me', [ExplorerController::class, 'show']);
    Route::get('/explorers/history', [ExplorerController::class, 'getHistory']);;
    Route::get('/reports', [ItemController::class, 'show']);
    Route::post('/items', [ItemController::class, 'store']);
});

