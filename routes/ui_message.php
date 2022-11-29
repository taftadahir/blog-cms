<?php

use App\Http\Controllers\UIMessageController;
use Illuminate\Support\Facades\Route;

Route::controller(UIMessageController::class)->middleware('auth')->name('ui_messages.')->group(function () {
	Route::get('/ui_messages/create', 'create')->name('create');
	Route::post('/ui_messages', 'store')->name('store');

	Route::get('/ui_messages/{uIMessage}/edit', 'edit')->name('edit');
	Route::put('/ui_messages/{uIMessage}', 'update')->name('update');
});
