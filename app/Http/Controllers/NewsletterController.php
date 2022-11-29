<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Models\Newsletter;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class NewsletterController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		return Inertia::render('Newsletter/Create');
	}

	public function store(StoreNewsletterRequest $request)
	{
		$validated = $request->validated();
		Newsletter::create($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Newsletter $newsletter)
	{
	}

	public function edit(Newsletter $newsletter)
	{
	}

	public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
	{
	}

	public function destroy(Newsletter $newsletter)
	{
	}
}
