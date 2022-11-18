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

	}

	public function edit(Role $role)
	{

	}

	public function update(UpdateRoleRequest $request, Role $role)
	{

	}

	public function destroy(Role $role)
	{

	}
}
