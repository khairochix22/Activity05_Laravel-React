<?php

use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HumanResourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/payroll', [HumanResourceController::class, 'payroll']);
Route::post('/payroll/calculate', [HumanResourceController::class, 'calculate']);

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/products/query', [ProductController::class, 'query'])->name('products.query');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::prefix('v1')->group(function (): void {
    Route::get('/products/query', [ProductController::class, 'query']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{product}', [ProductController::class, 'show']);
});
