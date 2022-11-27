<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class CommentController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		$articles = Article::all();
		$comments = Comment::all();
		return Inertia::render('Comment/Create', compact('articles', 'comments'));
	}

	public function store(StoreCommentRequest $request)
	{
		$validated = $request->validated();
		$comment = new Comment($validated);

		if (isset($validated['parent_id'])) {
			$parent = Comment::find($validated['parent_id']);
			$comment->parent()->associate($parent);
		}

		if (auth()->check()) {
			$user = User::find(auth()->id());
			$comment->user()->associate($user);
		}

		$article = Article::find($validated['article_id']);
		$article->comments()->save($comment);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Comment $comment)
	{
	}

	public function edit(Comment $comment)
	{
		$articles = Article::all();
		$comments = Comment::all();
		return Inertia::render('Comment/Edit', compact('articles', 'comments', 'comment'));
	}

	public function update(UpdateCommentRequest $request, Comment $comment)
	{
		$validated = $request->validated();

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'content' || $key == 'article_id') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		if (isset($validated['parent_id'])) {
			if (is_null($validated['parent_id'])) {
				$comment->parent()->disassociate();
			} else {
				$parent = Comment::find($validated['parent_id']);
				$comment->parent()->associate($parent);
			}
		}

		if (isset($validated['article_id']) && !is_null($validated['article_id']) && $validated['article_id'] != $comment->article_id) {
			$article = Article::find($validated['article_id']);
			$comment->article()->associate($article);
		}

		$comment->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Comment $comment)
	{
		$comment->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
