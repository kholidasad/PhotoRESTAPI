<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PhotoController;
use App\Http\Controllers\API\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/photos', [PhotoController::class, 'create'])->middleware('auth:sanctum');
Route::get('/photos', [PhotoController::class, 'index']);
Route::get('/photos/{id}', [PhotoController::class, 'detail']);
Route::put('/photos/{id}', [PhotoController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/photos/{id}', [PhotoController::class, 'delete'])->middleware('auth:sanctum');
Route::post('/photos/{id}/like', [PhotoController::class, 'like'])->middleware('auth:sanctum');
Route::post('/photos/{id}/unlike', [PhotoController::class, 'unlike'])->middleware('auth:sanctum');

Route::get('/photos/{id}/count', [PhotoController::class, 'count']);
