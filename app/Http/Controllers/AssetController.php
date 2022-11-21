<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Models\Asset;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class AssetController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		return Inertia::render('Asset/Create');
	}

	public function store(StoreAssetRequest $request)
	{
		$request->validated();

		$file = $request->file('asset');
		$extension = $file->clientExtension();
		$file->store('assets', 'public');
		$hashName = $file->hashName();

		Asset::create([
			'name' => pathinfo($hashName, PATHINFO_FILENAME),
			'original_name' => $file->getClientOriginalName(),
			'filename' => $hashName,
			'extension' => $extension
		]);

		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Asset $asset)
	{
	}

	public function edit(Asset $asset)
	{
		return Inertia::render('Asset/Edit', compact('asset'));
	}

	public function update(UpdateAssetRequest $request, Asset $asset)
	{
		$validated = $request->validated();

		$asset->update($validated);

		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Asset $asset)
	{
		$asset->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
