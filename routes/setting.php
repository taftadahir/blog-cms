<?php

use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::controller(SettingController::class)->middleware('auth')->name('settings.')->group(function () {
	Route::get('/settings/create', 'create')->name('create');
	Route::post('/settings', 'store')->name('store');
});
