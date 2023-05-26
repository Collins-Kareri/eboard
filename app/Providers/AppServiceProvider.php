<?php

namespace App\Providers;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(! $this->app->isProduction());

        Collection::macro(
            'filterOut',
            function (array $filters) {
                $currentData=$this;
                foreach($filters as $filterKey=>$filterValue) {
                    if(Str::of($filterValue)->trim()->isEmpty()) {
                        continue;
                    }

                    $filteredVal=$currentData->whereIn($filterKey, Str::of($filterValue)->explode(','));

                    $currentData=collect($filteredVal)->isEmpty() ? $currentData : $filteredVal;
                }
                return $currentData;
            }
        );
    }
}
