<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::controller(LanguageController::class)->name('languages.')->group(function () {
	Route::get('/language/{language}', 'show')->name('show');
});

Route::controller(LanguageController::class)->middleware('auth')->name('languages.')->group(function () {
	Route::get('/languages/create', 'create')->name('create');
	Route::post('/languages', 'store')->name('store');

	Route::get('/languages/{language}/edit', 'edit')->name('edit');
	Route::put('/languages/{language}', 'update')->name('update');

	Route::delete('/languages/{language}', 'destroy')->name('destroy');
});
