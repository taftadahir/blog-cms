<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class LanguageController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		return Inertia::render('Language/Create');
	}

	public function store(StoreLanguageRequest $request)
	{
		$validated = $request->validated();
		Language::create($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Language $language)
	{
	}

	public function edit(Language $language)
	{
		return Inertia::render('Language/Edit', compact('language'));
	}

	public function update(UpdateLanguageRequest $request, Language $language)
	{
		$validated = $request->validated();

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'title' || $key == 'iso_code') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		$language->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Language $language)
	{
		$language->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
