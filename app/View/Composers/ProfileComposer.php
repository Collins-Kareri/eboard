<?php

namespace App\View\Composers;

use App\Models\User;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * Create a new profile composer.
     */
    public function __construct()
    {
    }

    private function get_current_user()
    {
        return app('current_user');
    }

    /**
     * Bind data to the view
     */
    public function compose(View $view): void
    {
        $user = $this->get_current_user();
        $view->with('user', $user);
    }
}
