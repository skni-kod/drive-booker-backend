<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static whereIntegerInRaw(string $string, $driverIds)
 */
class Event extends Model
{
    protected $fillable = ['title', 'start', 'end', 'user_id'];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
