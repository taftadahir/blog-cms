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
	}

	public function update(UpdateLanguageRequest $request, Language $language)
	{
	}

	public function destroy(Language $language)
	{
	}
}
