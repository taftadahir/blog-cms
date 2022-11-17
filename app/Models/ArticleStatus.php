<?php

namespace App\Models;

class ArticleStatus
{
	public const DRAFT = 'draft';
	public const PUBLISHED = 'published';
	public const PRIVATE = 'private';
	public const ARCHIVED = 'archived';
	public const OUTDATED = 'outdated';
	public const WAITING_APPROVAL = 'waiting_approval';
	public const APPROVED = 'approved';
	public const REJECTED = 'rejected';

	public const ALL = [
		ArticleStatus::DRAFT => 'Draft',
		ArticleStatus::PUBLISHED => 'Published',
		ArticleStatus::PRIVATE => 'Private',
		ArticleStatus::ARCHIVED => 'Archived',
		ArticleStatus::OUTDATED => 'Outdated',
		ArticleStatus::WAITING_APPROVAL => 'Waiting approval',
		ArticleStatus::APPROVED => 'Approved',
		ArticleStatus::REJECTED => 'Rejected'
	];
}
