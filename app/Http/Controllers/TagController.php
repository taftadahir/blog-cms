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
		return Inertia::render('Tag/Edit', compact('tag'));
	}

	public function update(UpdateTagRequest $request, Tag $tag)
	{
		$validated = $request->validated();

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'title' || $key == 'slug') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		if (isset($validated['published']) && $validated['published'] == true) {
			$validated['published_at'] = Carbon::now();
			$user = User::find(auth()->id());
			$tag->publishedBy()->associate($user);
		}

		$tag->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Tag $tag)
	{
		$tag->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
