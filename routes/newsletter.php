<?php

use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

Route::controller(NewsletterController::class)->middleware('auth')->name('newsletters.')->group(function () {
	Route::get('/newsletters/create', 'create')->name('create');
	Route::post('/newsletters', 'store')->name('store');
});
