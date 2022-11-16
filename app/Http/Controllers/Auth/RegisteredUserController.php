<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegisteredUserController extends Controller
{
	public function create()
	{
		return Inertia::render('Auth/Register');
	}

	public function store(RegisterRequest $request)
	{
		$validated = $request->validated();

		$user = User::create([
			'name' => $validated['name'],
			'email' => $validated['email'],
			'password' => Hash::make($validated['password']),
		]);

		Auth::login($user);

		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Request $request){
		$id = Auth::id();
		$user = User::findOrFail($id);

		Auth::guard('web')->logout();
		$request->session()->invalidate();
		$user->delete();

		return redirect()->route(RouteServiceProvider::HOME);
	}
}
