<?php

namespace App\Models;

use Database\Factories\SchoolFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $school_id
 * @property string $name
 * @property string $address
 * @property string $postal_code
 * @property string $city
 */
class School extends Model
{
    /** @use HasFactory<SchoolFactory> */
    use HasFactory;

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
