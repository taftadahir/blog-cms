<?php

use App\Http\Controllers\AssetController;
use Illuminate\Support\Facades\Route;

Route::controller(AssetController::class)->middleware('auth')->name('assets.')->group(function () {
	Route::get('/assets/create', 'create')->name('create');
	Route::post('/assets', 'store')->name('store');

	Route::get('/assets/{asset}/edit', 'edit')->name('edit');
	Route::put('/assets/{asset}', 'update')->name('update');
});
