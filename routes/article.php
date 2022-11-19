<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ArticleController;

Route::controller(ArticleController::class)->middleware('auth')->name('articles.')->group(function () {
	Route::get('/article/{article}', 'show')->name('show');

	Route::get('/articles/create', 'create')->name('create');
	Route::post('/articles', 'store')->name('store');

	Route::get('/articles/{article}/edit', 'edit')->name('edit');
	Route::put('/articles/{article}', 'update')->name('update');

	Route::delete('/articles/{article}', 'destroy')->name('destroy');
});
