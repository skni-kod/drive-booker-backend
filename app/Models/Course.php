<?php

namespace App\Models;

use App\Casts\Money;
use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $school_id
 * @property int $category_id
 * @property int $price
 * @property string $currency
 */
class Course extends Model
{
    /** @use HasFactory<CourseFactory> */
    use HasFactory;

    protected $fillable = [
        'start_date',
        'school_id',
        'category_id',
        'price',
        'currency',
    ];

    protected $casts = [
        'price' => Money::class,
    ];

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
