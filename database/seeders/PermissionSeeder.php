<?php

namespace Database\Seeders;

use App\Constants\PermissionSlug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PermissionSlug::toArray() as $permissionSlug) {
            Permission::query()->create([
                'name' => $permissionSlug,
            ]);
        };
    }
}
