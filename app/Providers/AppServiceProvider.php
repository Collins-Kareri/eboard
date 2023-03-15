<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->singleton('current_user', function () {
            $user = User::find(1);
            return $user;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Model::shouldBeStrict(!$this->app->isProduction());
    }
}
