<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
	use HandlesAuthorization;

	private function viewAny(?User $user)
	{
		if ($user) {
			return $user->hasPermission('view-any-comment');
		}

		return false;
	}

	public function view(?User $user, Comment $comment)
	{
		if (($user && $comment->user() && $user->id == $comment->user->id) || $comment->status == 'approved') {
			return true;
		}

		return $this->viewAny($user);
	}

	public function create(User $user)
	{
		return $user->hasPermission('create-comment');
	}

	private function updateAny(User $user)
	{
		if ($user) {
			return $user->hasPermission('update-any-comment');
		}

		return false;
	}

	public function update(User $user, Comment $comment)
	{
		if ($this->updateAny($user)) {
			return true;
		}

		return $comment->user() && ($user->id == $comment->user->id);
	}

	private function deleteAny(User $user)
	{
		if ($user) {
			return $user->hasPermission('delete-any-comment');
		}

		return false;
	}

	public function delete(User $user, Comment $comment)
	{
		if ($comment->user() && ($user->id == $comment->user->id)) {
			return true;
		}

		return $this->deleteAny($user);
	}

	public function restore(User $user, Comment $comment)
	{
	}

	public function forceDelete(User $user, Comment $comment)
	{
	}
}
