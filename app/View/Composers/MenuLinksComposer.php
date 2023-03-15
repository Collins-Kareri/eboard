<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Str;

class MenuLinksComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {
    }

    /**
     * Takes an array of values and an array of keys.
     * Then returns an associative array
     */
    private function toAssocArr(array $values, array $keys)
    {
        $results = collect($values)->map(function (string $value) use ($keys) {
            $segments = Str::of($value)->split('/[,]+/');
            return collect($keys)->combine($segments);
        });
        return $results;
    }

    /**
     * Bind data to the view
     */
    public function compose(View $view): void
    {
        /**
         * an array of strings formatted with textContent,icon and route
         */
        $linksInfo = [
            'home,house-user,/',
            'employees,people-group,employees',
            'tasks,calendar-check,tasks',
            'settings,gear,settings'
        ];

        $linksInfo = $this->toAssocArr($linksInfo, ['textContent', 'icon', 'route']);

        $view->with('links', $linksInfo);
    }
}
