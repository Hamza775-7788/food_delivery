<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post("signUp", [UserController::class, "signUp"]);
Route::get("profileUser", [UserController::class, "show"])->middleware('auth:sanctum');
Route::apiResource("category", CategoryController::class);
Route::get("category/{id}/product", [CategoryController::class, "getProduct"]);
Route::apiResource("profile", ProfileController::class)->middleware('auth:sanctum');
// Route::apiResource("product", ProductController::class)->middleware('auth:sanctum');
Route::apiResource("product", ProductController::class);
Route::post("file", [StorageController::class, "store"]);
Route::post("code", [UserController::class, "verifyCode"]);
Route::post("signIn", [UserController::class, 'signIn']);
Route::post("forgot", [UserController::class, "forgot"]);
Route::post("reset", [UserController::class, "reset"]);

// psotman 