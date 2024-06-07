<?php

namespace App\Providers;

use App\Repositories\Admin\UserManageRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Site\SiteRepository;
use App\Repositories\Site\SiteRepositoryInterface;
use App\Repositories\Admin\UserManageRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SiteRepositoryInterface::class, SiteRepository::class);
        $this->app->bind(UserManageRepositoryInterface::class, UserManageRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
