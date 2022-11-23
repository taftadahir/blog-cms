<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->middleware('auth')->name('categories.')->group(function () {
	Route::get('/categories/create', 'create')->name('create');
	Route::post('/categories', 'store')->name('store');
});
