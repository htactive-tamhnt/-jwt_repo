<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Repositories\RepositoryInterface;
use App\Repositories\Repository;
use App\Repositories\Comments\CommentInterface;
use App\Repositories\Comments\CommentRepo;
use App\Services\CommentService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class,Repository::class);
        $this->app->singleton(CommentInterface::class,CommentRepo::class);
        $this->app->singleton(CommentService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
