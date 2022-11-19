<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class RoleController extends Controller
{
	public function index()
	{
	}

	public function create()
	{
		return Inertia::render('Role/Create');
	}

	public function store(StoreRoleRequest $request)
	{
		$validated = $request->validated();
		$user = User::find(auth()->id());

		$role = new Role($validated);
		$role->updatedBy()->associate($user);
		$role->createdBy()->associate($user);

		$role->save();
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(Role $role)
	{
		$this->authorize('view-any', Role::class);
		return $role;
	}

	public function edit(Role $role)
	{
		return Inertia::render('Role/Edit', [
			'role' => $role
		]);
	}

	public function update(UpdateRoleRequest $request, Role $role)
	{
		$validated = $request->validated();
		$user = User::find(auth()->id());

		# remove required fields which are null in the validated data but it should not be null
		$validated =  array_filter($validated, function ($value, $key) {
			if ($key == 'title' || $key == 'code') {
				return !is_null($value);
			}
			return true;
		}, ARRAY_FILTER_USE_BOTH);

		$role->updatedBy()->associate($user);
		$role->update($validated);
		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function destroy(Role $role)
	{
		$this->authorize('delete', Role::class);

		$user = User::find(auth()->id());
		$role->deletedBy()->associate($user)->save();
		$role->delete();

		return redirect()->route(RouteServiceProvider::HOME);
	}
}
