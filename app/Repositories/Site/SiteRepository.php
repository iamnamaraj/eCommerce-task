<?php

namespace App\Repositories\Site;

use App\Models\User;


class SiteRepository implements SiteRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function getUserRole($userId)
    {
        $user = User::find($userId);
        return $user ? $user->role : null;
    }
}
