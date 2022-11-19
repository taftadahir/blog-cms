<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\ArticleContentType;
use App\Models\ArticleStatus;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ArticleController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		$statuses = array_filter(
			ArticleStatus::ALL,
			fn ($key) => in_array($key, [
				ArticleStatus::DRAFT,
				ArticleStatus::PUBLISHED,
				ArticleStatus::PRIVATE,
			], true,),
			ARRAY_FILTER_USE_KEY
		);

		$contentTypes = ArticleContentType::ALL;

		$articles = Article::all(['id', 'title']);

		return Inertia::render('Article/Create', [
			'statuses' => $statuses,
			'contentTypes' => $contentTypes,
			'articles' => $articles,
		]);
	}

	public function store(StoreArticleRequest $request)
	{
		$validated = $request->validated();
		$user = User::find(auth()->id());

		# remove nulls
		$validated =  array_filter($validated, function ($value) {
			return !is_null($value);
		});

		if (isset($validated['status']) && $validated['status'] == ArticleStatus::PUBLISHED) {
			$validated['published_at'] = Carbon::now();
		}

		if (isset($validated['password'])) {
			$validated['password'] = Hash::make($validated['password']);
		}

		# sys id
		$validated = $this->sysid($validated);

		$article = new Article($validated);

		if (isset($validated['parent_id'])) {
			$parent = Article::find($validated['parent_id']);
			$article->parent()->associate($parent);
		}

		if (isset($validated['status']) && $validated['status'] == ArticleStatus::PUBLISHED) {
			$article->publishedBy()->associate($user);
		}

		$article->updatedBy()->associate($user);
		$user->createdArticles()->save($article);

		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Article $article)
	{
		$this->authorize('view', $article);
		return $article;
	}

	public function edit(Article $article)
	{
		$statuses = array_filter(
			ArticleStatus::ALL,
			fn ($key) => in_array($key, [
				ArticleStatus::DRAFT,
				ArticleStatus::PUBLISHED,
				ArticleStatus::PRIVATE,
				ArticleStatus::ARCHIVED,
				ArticleStatus::OUTDATED,
			], true,),
			ARRAY_FILTER_USE_KEY
		);

		$contentTypes = ArticleContentType::ALL;

		$articles = Article::all(['id', 'title']);

		return Inertia::render('Article/Edit', [
			'statuses' => $statuses,
			'contentTypes' => $contentTypes,
			'articles' => $articles,
			'article' => $article,
		]);
	}

	public function update(UpdateArticleRequest $request, Article $article)
	{
		$validated = $request->validated();
		$user = User::find(auth()->id());

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'title' || $key == 'slug' || $key == 'content_type' || $key == 'status') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		if (isset($validated['parent_id'])) {
			$parent = Article::find($validated['parent_id']);
			$article->parent()->associate($parent);
		}

		# status
		if (isset($validated['status'])) {
			if ($validated['status'] == ArticleStatus::ARCHIVED) {
				$validated['archived_at'] = Carbon::now();
				$article->archivedBy()->associate($user);
			}

			if ($validated['status'] == ArticleStatus::PUBLISHED) {
				$validated['published_at'] = Carbon::now();
				$article->publishedBy()->associate($user);
			}

			if ($validated['status'] == ArticleStatus::OUTDATED) {
				$validated['outdated_at'] = Carbon::now();
				$article->outdatedBy()->associate($user);
			}
		}

		# sysid
		$validated = $this->sysid($validated);

		$article->updatedBy()->associate($user);
		$article->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Article $article)
	{
		$this->authorize('delete', Article::class);

		$user = User::find(auth()->id());
		$article->deletedBy()->associate($user)->save();
		$article->delete();

		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function sysid($validated)
	{
		if (isset($validated['same_article_as']) && $validated['same_article_as'] != null) {
			$sameArticleAs = Article::find($validated['same_article_as']);
			$validated['sys_id'] = $sameArticleAs->sys_id;
		}

		if (isset($validated['new_sys_id']) && $validated['new_sys_id']) {
			$validated['sys_id'] = uniqid();
		}

		return $validated;
	}
}
