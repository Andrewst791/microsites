<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request, UserService $userService) : RedirectResponse
    {
        $userService->register($request->validated());
        return redirect()->to(route('users.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user) : Response
    {
        $user->role = count($user->roles) ? $user->roles()->first()->name : null;
        $roles = Role::all();
        $canEdit = false;
        return Inertia::render('User/Save', compact('user', 'roles', 'canEdit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user->role = count($user->roles) ? $user->roles()->first()->name : null;
        $roles = Role::all();
        $canEdit = true;
        return Inertia::render('User/Save', compact('user', 'roles', 'canEdit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user, UserService $userService) : RedirectResponse
    {
        $userService->update($user, $request->validated());
        return redirect()->to(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user) : RedirectResponse
    {
        $user->delete();
        return redirect()->back();
    }
}
