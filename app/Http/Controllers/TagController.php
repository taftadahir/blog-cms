<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Inertia\Inertia;

class TagController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		return Inertia::render('Tag/Create');
	}

	public function store(StoreTagRequest $request)
	{
		$validated = $request->validated();

		if (isset($validated['published']) && $validated['published'] == true) {
			$validated['published_at'] = Carbon::now();
		}

		$tag = new Tag($validated);

		if (isset($validated['published']) && $validated['published'] == true) {
			$user = User::find(auth()->id());
			$tag->publishedBy()->associate($user);
		}

		$tag->save();
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Tag $tag)
	{
	}

	public function edit(Tag $tag)
	{
	}

	public function update(UpdateTagRequest $request, Tag $tag)
	{
	}

	public function destroy(Tag $tag)
	{
	}
}
