<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Inertia\Inertia;

class CategoryController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		$categories = Category::all(['id', 'title']);
		return Inertia::render('Category/Create', compact('categories'));
	}

	public function store(StoreCategoryRequest $request)
	{
		$validated = $request->validated();

		if (isset($validated['published']) && $validated['published'] == true) {
			$validated['published_at'] = Carbon::now();
		}

		$category = new Category($validated);

		if (isset($validated['published']) && $validated['published'] == true) {
			$user = User::find(auth()->id());
			$category->publishedBy()->associate($user);
		}

		if (isset($validated['parent_id'])) {
			$parent = Category::find($validated['parent_id']);
			$category->parent()->associate($parent);
		}

		$category->save();
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Category $category)
	{
		$this->authorize('view', $category);
		return $category;
	}

	public function edit(Category $category)
	{
		$categories = Category::all(['id', 'title']);
		return Inertia::render('Category/Edit', compact('categories', 'category'));
	}

	public function update(UpdateCategoryRequest $request, Category $category)
	{
		$validated = $request->validated();

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'title' || $key == 'slug') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		if (isset($validated['parent_id'])) {
			$parent = Category::find($validated['parent_id']);
			$category->parent()->associate($parent);
		}

		if (isset($validated['published']) && $validated['published'] == true) {
			$validated['published_at'] = Carbon::now();
			$user = User::find(auth()->id());
			$category->publishedBy()->associate($user);
		}

		$category->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Category $category)
	{
		$this->authorize('delete', $category);
		$category->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
