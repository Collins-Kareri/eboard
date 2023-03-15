<?php

namespace App\Providers;

use App\View\Composers\CalenderComposer;
use Illuminate\Support\ServiceProvider;
use App\View\Composers\ProfileComposer;
use App\View\Composers\MenuLinksComposer;
use Illuminate\Support\Facades\View;

// use Illuminate\Support\Facades;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        // View::composer('tasks', CalenderComposer::class);
        View::composer('components.menu-links', MenuLinksComposer::class);
        View::composer('*', ProfileComposer::class);
    }
}
