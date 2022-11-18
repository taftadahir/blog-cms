<?php

use App\Http\Controllers\PermissionRoleController;
use Illuminate\Support\Facades\Route;

Route::controller(PermissionRoleController::class)->middleware('auth')->name('permission.role.')->group(function () {
	Route::get('/permissions/roles/create', 'create')->name('create');
	Route::post('/permissions/roles', 'store')->name('store');
});
