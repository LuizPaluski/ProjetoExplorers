<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ExplorerController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\TradeController;


Route::post('/explorers', [ExplorerController::class, 'store']);
Route::put('/explorers/{id}', [ExplorerController::class, 'updateLocation']);
Route::patch('/explorers/{id}', [ExplorerController::class, 'updateLocation']);
Route::get('/explorers/{id}', [ExplorerController::class, 'show']);
Route::get('/explorers/{id}/history', [ExplorerController::class, 'getHistory']);;
Route::get('/reports', [ItemController::class, 'show']);
Route::post('/items', [ItemController::class, 'store']);
Route::post('/trade', [TradeController::class, 'trade']);
