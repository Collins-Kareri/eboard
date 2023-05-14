<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepartmentInvitation extends Model
{
    use HasFactory;
    use HasUlids;
    use MassPrunable;

    protected $fillable=[
        'email'
    ];

    public function prunable(): Builder
    {
        return static::where('created_at', '<=', now()->subHours(24));
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
