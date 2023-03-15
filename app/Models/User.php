<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\HasAvatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasAvatar;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //check user factory to determine fillables
    protected $fillable = [
        'first_name',
        'last_name',
        'job_title',
        'phone_number',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'avatar_url' //from the useAvatar trait
    ];

    /**
     * Get the tasks for user.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Tasks::class);
    }

    /**
     * Get the departments for user.
     */
    public function departments(): BelongsTo
    {
        return $this->belongsTo(Departments::class);
    }
}
