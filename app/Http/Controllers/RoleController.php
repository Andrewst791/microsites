<?php

namespace App\Http\Controllers;

use App\Constants\PermissionSlug;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\Permission\Models\Role;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {
        return [
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::ROLES_VIEW_ANY), only: ['index']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::ROLES_CREATE), only: ['create', 'store']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::ROLES_UPDATE), only: ['edit', 'update']),
            new Middleware(\Spatie\Permission\Middleware\PermissionMiddleware::using(PermissionSlug::ROLES_DELETE), only: ['destroy']),
        ];
    }

    public function index() : Response
    {
        $roles = Role::with('permissions')->get();
        return Inertia::render('Role/Index', compact('roles'));
    }

    public function create()
    {
        //
    }

    public function store(StoreRoleRequest $request)
    {
        //
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        //
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        //
    }

    public function destroy(Role $role)
    {
        //
    }
}
