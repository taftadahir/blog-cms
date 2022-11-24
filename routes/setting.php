<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::controller(SettingController::class)->middleware('auth')->name('settings.')->group(function () {
	Route::get('/setting/{setting}', 'show')->name('show');

	Route::get('/settings/create', 'create')->name('create');
	Route::post('/settings', 'store')->name('store');

	Route::get('/settings/{setting}/edit', 'edit')->name('edit');
	Route::put('/settings/{setting}', 'update')->name('update');

	Route::delete('/settings/{setting}', 'destroy')->name('destroy');
});
