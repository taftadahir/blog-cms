<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
	return Inertia::render('Welcome', [
		'canLogin' => Route::has('login'),
		'canRegister' => Route::has('register'),
	]);
})->name('home');

Route::get('/dashboard', function () {
	return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/article.php';
require __DIR__ . '/role.php';
require __DIR__ . '/permission_role.php';
require __DIR__ . '/asset.php';
require __DIR__ . '/category.php';
require __DIR__ . '/tag.php';
require __DIR__ . '/setting.php';
require __DIR__ . '/comment.php';
require __DIR__ . '/language.php';
require __DIR__ . '/ui_message.php';
require __DIR__ . '/newsletter.php';
