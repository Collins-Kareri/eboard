<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departments extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Get user in departments
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
