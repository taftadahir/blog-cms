<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::controller(TagController::class)->middleware('auth')->name('tags.')->group(function () {
	Route::get('/tags/create', 'create')->name('create');
	Route::post('/tags', 'store')->name('store');
});
