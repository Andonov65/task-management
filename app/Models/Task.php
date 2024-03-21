<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    const VERY_LOW = 'very low';
    const LOW = 'low';
    const MEDIUM = 'medium';
    const HIGH = 'high';
    const VERY_HIGH = 'very high';

    const priorities = [self::VERY_LOW, self::LOW, self::MEDIUM, self::HIGH, self::VERY_HIGH];

    protected $fillable = [
        'name',
        'description',
        'is_completed',
        'priority',
        'due_date'
    ];

    protected $casts = [
        'is_completed' => 'boolean',
        'due_date' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
