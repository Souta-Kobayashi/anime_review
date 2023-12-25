<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/isLoggedIn', function () {
        return response()->json(['status' => 200, 'message' => 'this user is logged in.']);
    });

    Route::prefix('/category')->group(function () {
        Route::post('/create', [CategoryController::class, 'store']);
        Route::put('/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });

    Route::prefix('/anime')->group(function () {
        Route::post('/create', [VideoController::class, 'store']);
        Route::put('/{id}/rating', [VideoController::class, 'update_rating']);
        Route::put('/{id}/info', [VideoController::class, 'update_info']);
        Route::delete('/{id}', [VideoController::class, 'destroy']);
    });
});

Route::prefix('anime')->group(function () {
    Route::get('/', [VideoController::class, 'index']);
    Route::get('/{id}', [VideoController::class, 'show']);
});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
});
