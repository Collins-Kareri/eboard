<?php

use App\Enums\UserRole;
use Carbon\Carbon;

dataset('userdata', function () {
    return [
    'member'=>[fake()->email(),UserRole::Member->value],
    'manager'=>[fake()->email(),UserRole::Manager->value],
    'contractor'=>[fake()->email(),UserRole::Contractor->value,Carbon::now('utc'),'6 day']
];
});
