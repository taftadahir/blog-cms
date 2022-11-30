<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class CommentController extends Controller
{
	private $statuses = [
		'default' => 'Default',
		'approved' => 'Approved',
		'disapproved' => 'Disapproved',
	];

	public function index()
	{
	}

	public function create()
	{
		$articles = Article::all();
		$comments = Comment::all();
		return Inertia::render('Comment/Create', [
			'articles' => $articles,
			'comments' => $comments,
			'statuses' => $this->statuses,
		]);
	}

	public function store(StoreCommentRequest $request)
	{
		$validated = $request->validated();
		$article = Article::find($validated['article_id']);

		# if status is null, 
		# check article comment status - use it only if not default
		# check general comment status - use it even if default as it is last resort
		if (!isset($validated['status'])) {
			if (!is_null($article->default_comment_status) && $article->default_comment_status != 'default') {
				$validated['status'] = $article->default_comment_status;
			} else {
				$commentStatusSetting = Setting::where('code', 'default_comment_status')->first();
				if ($commentStatusSetting) {
					$validated['status'] = $commentStatusSetting->value;
				}
			}
		}

		$comment = new Comment($validated);

		if (isset($validated['parent_id'])) {
			$parent = Comment::find($validated['parent_id']);
			$comment->parent()->associate($parent);
		}

		if (auth()->check()) {
			$user = User::find(auth()->id());
			$comment->user()->associate($user);
		}

		$article->comments()->save($comment);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Comment $comment)
	{
		$this->authorize('view', $comment);
		return $comment;
	}

	public function edit(Comment $comment)
	{
		$articles = Article::all();
		$comments = Comment::all();

		return Inertia::render('Comment/Edit', [
			'articles' => $articles,
			'comments' => $comments,
			'comment' => $comment,
			'statuses' => $this->statuses,
		]);
	}

	public function update(UpdateCommentRequest $request, Comment $comment)
	{
		$validated = $request->validated();

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'content' || $key == 'article_id' || $key == 'status') {
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
		$this->authorize('delete', $comment);
		$comment->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
