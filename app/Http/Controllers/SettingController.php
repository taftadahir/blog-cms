<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class SettingController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		$users = User::all(['id', 'name']);
		return Inertia::render('Setting/Create', compact('users'));
	}

	public function store(StoreSettingRequest $request)
	{
		$validated = $request->validated();
		$setting = new Setting($validated);

		if (isset($validated['user_id'])) {
			$user = User::find($validated['user_id']);
			$setting->user()->associate($user);
		}

		$setting->save();
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Setting $setting)
	{
	}

	public function edit(Setting $setting)
	{
	}

	public function update(UpdateSettingRequest $request, Setting $setting)
	{
	}

	public function destroy(Setting $setting)
	{
	}
}
