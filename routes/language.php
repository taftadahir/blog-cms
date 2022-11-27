<?php

use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\Route;

Route::controller(LanguageController::class)->middleware('auth')->name('languages.')->group(function () {
	Route::get('/languages/create', 'create')->name('create');
	Route::post('/languages', 'store')->name('store');
});
