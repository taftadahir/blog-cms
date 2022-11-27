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
	}

	public function update(UpdateCommentRequest $request, Comment $comment)
	{
	}

	public function destroy(Comment $comment)
	{
	}
}
