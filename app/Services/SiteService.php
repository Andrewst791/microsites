<?php
namespace App\Services;

use App\Models\Site;

class SiteService
{
    public function register(array $data) : Site
    {
        $user           = new Site();
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->assignRole($data['role']);
        return $user;
    }

    public function update(Site $user, array $data) : Site
    {
        if(!isset($data['password'])) {
            unset($data['password']);
        }
        if(isset($data['role'])) {
            $user->syncRoles([$data['role']]);
            unset($data['role']);
        }
        $user->update($data);
        return $user;
    }
}
