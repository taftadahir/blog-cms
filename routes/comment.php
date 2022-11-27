<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::controller(CommentController::class)->name('comments.')->group(function () {
	Route::get('/comments/create', 'create')->name('create');
	Route::post('/comments', 'store')->name('store');
});

Route::controller(CommentController::class)->middleware('auth')->name('comments.')->group(function () {
	Route::get('/comments/{comment}/edit', 'edit')->name('edit');
	Route::put('/comments/{comment}', 'update')->name('update');
});
