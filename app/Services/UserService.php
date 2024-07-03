<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function register(array $data) : User
    {
        $user           = new User();
        $user->name     = $data['name'];
        $user->email    = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->assignRole($data['role']);
        return $user;
    }

    public function update(User $user, array $data) : User
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
