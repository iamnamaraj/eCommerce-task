<?php

namespace App\Providers;

use App\Repositories\Admin\CategoriesManageRepository;
use App\Repositories\Admin\CategoriesManageRepositoryInterface;
use App\Repositories\Admin\ProductRepository;
use App\Repositories\Admin\ProductRepositoryInterface;
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
        $this->app->bind(CategoriesManageRepositoryInterface::class, CategoriesManageRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
