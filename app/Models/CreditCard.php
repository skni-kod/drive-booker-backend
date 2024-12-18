<?php

namespace App\Models;

use Database\Factories\CreditCardFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CreditCard extends Model
{
    /** @use HasFactory<CreditCardFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_first_name',
        'card_last_name',
        'card_number',
        'card_expiry_date',
        'card_cvv',
    ];

    protected function casts(): array
    {
        return [
            'card_number' => 'hashed',
            'card_expiry_date' => 'hashed',
            'card_cvv' => 'hashed',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
