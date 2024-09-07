<?php

namespace App\Http\Controllers;

use App\Constants\PermissionSlug;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {
        return [
            new Middleware('permission:' . PermissionSlug::USERS_VIEW, only: ['index']),
            new Middleware('permission:' . PermissionSlug::USERS_CREATE, only: ['create', 'store']),
            new Middleware('permission:' . PermissionSlug::USERS_UPDATE, only: ['edit', 'update']),
            new Middleware('permission:' . PermissionSlug::USERS_DELETE, only: ['destroy']),
        ];
    }

    public function index(Request $request) : Response
    {
        $users = User::with('roles')
            ->when($request->has('search'), function($query) use ($request) {
                $query->where('name', 'REGEXP', $request->search)
                    ->orWhere('email', 'REGEXP', $request->search);
            })
            ->paginate(10);
        return Inertia::render('User/Index', compact('users'));
    }

    public function create() : Response
    {
        $user = [
            'id'    => null,
            'name'  => null,
            'email' => null,
            'roles' => null
        ];
        $roles = Role::all();
        $canEdit = true;
        return Inertia::render('User/Save', compact('user', 'roles', 'canEdit'));
    }


    public function store(StoreUserRequest $request, UserService $userService) : RedirectResponse
    {
        $userService->register($request->validated());
        return redirect()->to(route('users.index'));
    }

    public function show(User $user) : Response
    {
        $user->role = count($user->roles) ? $user->roles()->first()->name : null;
        $roles = Role::all();
        $canEdit = false;
        return Inertia::render('User/Save', compact('user', 'roles', 'canEdit'));
    }

    public function edit(User $user)
    {
        $user->role = count($user->roles) ? $user->roles()->first()->name : null;
        $roles = Role::all();
        $canEdit = true;
        return Inertia::render('User/Save', compact('user', 'roles', 'canEdit'));
    }

    public function update(UpdateUserRequest $request, User $user, UserService $userService) : RedirectResponse
    {
        $userService->update($user, $request->validated());
        return redirect()->to(route('users.index'));
    }

    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();
        return redirect()->back();
    }
}
