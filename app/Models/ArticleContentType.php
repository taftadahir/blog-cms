<?php

namespace App\Models;

class ArticleContentType
{
	public const HTML = 'html';
	public const MARKDOWN = 'markdown';

	public const ALL = [
		ArticleContentType::HTML => 'HTML',
		ArticleContentType::MARKDOWN => 'Markdown'
	];
}
