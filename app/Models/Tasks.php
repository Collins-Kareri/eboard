<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tasks extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'description',
        'deadline',
        'start_time',
        'end_time',
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime:h:i A',
        'end_time' => 'datetime:h:i A'
    ];

    /**
     * Get the user that the task.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
