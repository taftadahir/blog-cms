<?php

use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::controller(TagController::class)->middleware('auth')->name('tags.')->group(function () {
	Route::get('/tag/{tag}', 'show')->name('show');

	Route::get('/tags/create', 'create')->name('create');
	Route::post('/tags', 'store')->name('store');

	Route::get('/tags/{tag}/edit', 'edit')->name('edit');
	Route::put('/tags/{tag}', 'update')->name('update');

	Route::delete('/tags/{tag}', 'destroy')->name('destroy');
});
