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
		$users = User::all(['id', 'name']);
		return Inertia::render('Setting/Edit', compact('setting', 'users'));
	}

	public function update(UpdateSettingRequest $request, Setting $setting)
	{
		$validated = $request->validated();

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'code') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		if (isset($validated['user_id'])) {
			$user = User::find($validated['user_id']);
			$setting->user()->associate($user);
		} else {
			$setting->user()->disassociate();
		}

		$setting->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Setting $setting)
	{
		$setting->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
