<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleUserRequest;
use App\Http\Requests\UpdateRoleUserRequest;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class RoleUserController extends Controller
{
    public function index()
    {

    }

    public function create()
    {
		$roles = Role::all(['id', 'title']);
		$users = User::all(['id', 'name']);

		return Inertia::render('RoleUser/Create', [
			'roles' => $roles,
			'users' => $users,
		]);
    }

    public function store(StoreRoleUserRequest $request)
    {
		$validated = $request->validated();
		$roleUserCheck = RoleUser::where(
			'role_id',
			$validated['role_id']
		)->where(
			'user_id',
			$validated['user_id']
		)->first();

		if($roleUserCheck){
			$role = Role::where('id', $validated['role_id'])->first();
			$user = User::where('id', $validated('user_id'))->first();

			$roleUser = new RoleUser();
			$roleUser->role()->associate($role);
			$roleUser->user()->associate($user);

			$roleUser->save();
		}

		return redirect()->route(RouteServiceProvider::HOME);
    }

    public function show(RoleUser $roleUser)
    {

    }

    public function edit(RoleUser $roleUser)
	{

    }

    public function update(UpdateRoleUserRequest $request, RoleUser $roleUser)
	{

    }

    public function destroy(RoleUser $roleUser)
	{

    }
}
