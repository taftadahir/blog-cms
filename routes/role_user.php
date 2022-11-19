<?php

use App\Http\Controllers\RoleUserController;
use Illuminate\Support\Facades\Route;

Route::controller(RoleUserController::class)->middleware('auth')->name('role.user.')->group(function () {
	Route::get('/roles/users/create', 'create')->name('create');
	Route::post('/roles/users', 'store')->name('store');

	Route::delete('/roles/users/{role_user}', 'destroy')->name('destroy');
});
