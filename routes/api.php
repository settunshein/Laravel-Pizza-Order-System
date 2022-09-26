<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Category
Route::get('/category',              [RouteController::class, 'getCategoryList']);
Route::post('/category/create',      [RouteController::class, 'createCategory']);
Route::post('/category/delete/{id}', [RouteController::class, 'deleteCategory']);
Route::get('/category/{id}',         [RouteController::class, 'getCategoryDetails']);
Route::post('/category/edit/{id}',   [RouteController::class, 'updateCategory']);

// Product
Route::get('/product', [RouteController::class, 'getProductList']);

// Contact Message
Route::get('/contact-msg',         [RouteController::class, 'getContactMessageList']);
Route::post('/contact-msg/create', [RouteController::class, 'createContactMessage']);