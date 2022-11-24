<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::controller(CategoryController::class)->middleware('auth')->name('categories.')->group(function () {
	Route::get('/category/{category}', 'show')->name('show');

	Route::get('/categories/create', 'create')->name('create');
	Route::post('/categories', 'store')->name('store');

	Route::get('/categories/{category}/edit', 'edit')->name('edit');
	Route::put('/categories/{category}', 'update')->name('update');

	Route::delete('/categorys/{category}', 'destroy')->name('destroy');
});
