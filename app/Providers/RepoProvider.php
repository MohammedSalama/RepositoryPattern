<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RepositoryPattern\PostRepo;
use RepositoryPattern\Repo;

class RepoProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(Repo::class , PostRepo::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
