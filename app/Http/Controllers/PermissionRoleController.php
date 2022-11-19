<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermissionRoleRequest;
use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class PermissionRoleController extends Controller
{
	public function index()
	{

	}

	public function create()
	{
		$roles = Role::all(['id', 'title']);
		$permissions = Permission::all(['id', 'title']);

		return Inertia::render('PermissionRole/Create', [
			'roles' => $roles,
			'permissions' => $permissions,
		]);
	}

	public function store(StorePermissionRoleRequest $request)
	{
		$validated = $request->validated();
		$permissionRoleCheck = PermissionRole::where(
			'role_id',
			$validated['role_id']
		)->where(
			'permission_id',
			$validated['permission_id']
		)->first();

		if (!$permissionRoleCheck) {
			# if doesn't exist, then create it
			$permission = Permission::where('id', $validated['permission_id'])->first();
			$role = Role::where('id', $validated['role_id'])->first();

			$permissionRole = new PermissionRole();
			$permissionRole->permission()->associate($permission);
			$permissionRole->role()->associate($role);

			$permissionRole->save();
		}

		return redirect()->route(RouteServiceProvider::HOME);
	}

	public function show(PermissionRole $permissionRole)
	{

	}

	public function destroy(PermissionRole $permissionRole)
	{
		$permissionRole->delete();
		return redirect()->route(RouteServiceProvider::HOME);
	}
}
