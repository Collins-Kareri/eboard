<?php

namespace App\Models;

use App\Enums\UserRole;
use App\Helpers\EmployeeID;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\HasAvatar;
use App\Traits\UserInvite;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasAvatar;
    use HasUlids;
    use UserInvite;

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
        'password',
        'job_title',
        'avatar',
        'role',
        'employeeID'
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
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['departments'];

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
     * Set automatic generations of employee id
     */
    public function employeeID(): Attribute
    {
        return Attribute::make(
            set:function () {
                if($this->role === UserRole::Contractor->value) {
                    // $this->employeeID=EmployeeID::contractorId();
                    return EmployeeID::contractorId();
                } else {
                    // $this->employeeID=EmployeeID::generate();
                    return EmployeeID::generate();
                }
            }
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
