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
	}

	public function edit(Category $category)
	{
	}

	public function update(UpdateCategoryRequest $request, Category $category)
	{
	}

	public function destroy(Category $category)
	{
	}
}
