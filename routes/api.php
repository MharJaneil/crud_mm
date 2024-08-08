<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


Route::apiResource('/categories', CategoryController::class);
Route::apiResource('/items', ItemController::class);
Route::get('/items-with-category', [ItemController::class, 'itemsWithCategory']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return 'Database connection is working!';
    } catch (\Exception $e) {
        return 'Database connection error: ' . $e->getMessage();
    }
});

