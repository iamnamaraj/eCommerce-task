<?php

namespace App\Repositories\Admin;

use App\Models\User;

class UserManageRepository implements UserManageRepositoryInterface
{
    public function allUsers($perPage)
    {
        return User::latest()->paginate($perPage);
    }

    public function storeUser(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function updateUser(User $user, $data)
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return $user;
    }

    public function userDelete(User $user)
    {
        $user->delete();
    }
}
