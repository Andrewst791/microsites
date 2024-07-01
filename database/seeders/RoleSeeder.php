<?php

namespace Database\Seeders;

use App\Constants\PermissionSlug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Admin',
            'Guest',
            'Customer'
        ];

        foreach ($roles as $role) {
            $roleCreate = new Role;
            $roleCreate->name = $role;
            $roleCreate->save();
            if($role == 'Admin') {
                foreach (PermissionSlug::toArray() as $permissionSlug) {
                    $roleCreate->givePermissionTo($permissionSlug);
                };
            } elseif($role == 'Customer') {
                $roleCreate->givePermissionTo(PermissionSlug::SITES_VIEW_ANY);
                $roleCreate->givePermissionTo(PermissionSlug::SITES_VIEW);
                $roleCreate->givePermissionTo(PermissionSlug::SITES_UPDATE);
                $roleCreate->givePermissionTo(PermissionSlug::SITES_CREATE);
                $roleCreate->givePermissionTo(PermissionSlug::SITES_DELETE);
            } else if ($role == 'Guest') {
                $roleCreate->givePermissionTo(PermissionSlug::SITES_VIEW_ANY);
                $roleCreate->givePermissionTo(PermissionSlug::SITES_VIEW);
            }
        }
    }
}
