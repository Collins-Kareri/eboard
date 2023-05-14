<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasAvatar;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasAvatar;
    use HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'address',
        'password',
        'job_title',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'first_name',
        'last_name'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

    /**
    * The accessors to append to the model's array form.
    *
    * @var array<int, string>
    */
    protected $appends = [
        'avatar_url', //from the useAvatar trait
        'full_name',
        'current_department'
    ];

    /**
     * Returns connate of first_name and last_name columns.
     */
    public function fullName(): Attribute
    {
        return Attribute::make(
            get:fn () =>ucfirst($this->first_name).' '.ucfirst($this->last_name)
        );
    }

    /**
     * Get user department
     */
    public function currentDepartment(): Attribute
    {
        return Attribute::get(
            function () {
                return $this->departments->name;
            }
        );

    }

    /**
     * Get the tasks for user.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Tasks::class);
    }

    /**
     * Each user belongs to a single department.
     */
    public function departments(): BelongsTo
    {
        return $this->belongsTo(Departments::class);
    }

    /**
     * Get the department invitations from user.
     */
    public function departmentInvitations(): HasMany
    {
        return $this->hasMany(DepartmentInvitation::class);
    }
}
