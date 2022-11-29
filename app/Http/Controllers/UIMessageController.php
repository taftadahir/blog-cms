<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUIMessageRequest;
use App\Http\Requests\UpdateUIMessageRequest;
use App\Models\Language;
use App\Models\UIMessage;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class UIMessageController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		$languages = Language::all();
		return Inertia::render('UIMessage/Create', compact('languages'));
	}

	public function store(StoreUIMessageRequest $request)
	{
		$validated = $request->validated();
		$uIMessage = new UIMessage($validated);

		$language = Language::where('id', $validated['lang'])->first();
		$language->uIMessages()->save($uIMessage);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(UIMessage $uIMessage)
	{
	}

	public function edit(UIMessage $uIMessage)
	{
		$languages = Language::all();
		return Inertia::render('UIMessage/Edit', compact('languages', 'uIMessage'));
	}

	public function update(UpdateUIMessageRequest $request, UIMessage $uIMessage)
	{
		$validated = $request->validated();

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'lang' || $key == 'code') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		if (isset($validated['lang']) && $validated['lang'] != $uIMessage->language_id) {
			$language = Language::where('id', $validated['lang'])->first();
			$uIMessage->language()->associate($language);
		}

		$uIMessage->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(UIMessage $uIMessage)
	{
		$uIMessage->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
