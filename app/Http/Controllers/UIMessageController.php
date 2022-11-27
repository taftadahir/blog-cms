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
	}

	public function update(UpdateUIMessageRequest $request, UIMessage $uIMessage)
	{
	}

	public function destroy(UIMessage $uIMessage)
	{
	}
}
