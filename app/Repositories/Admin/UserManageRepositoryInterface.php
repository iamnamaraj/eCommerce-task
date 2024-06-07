<?php

namespace App\Repositories\Admin;

use App\Models\User;

interface UserManageRepositoryInterface
{
    public function allUsers($perPage);
    public function storeUser(array $data);
    public function getUserById($id);
    public function updateUser(User $user, $data);
    public function userDelete(User $user);
}
