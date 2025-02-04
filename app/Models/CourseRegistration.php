<?php

namespace App\Models;

use Database\Factories\CourseRegistrationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseRegistration extends Model
{
    /** @use HasFactory<CourseRegistrationFactory> */
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'last_name',
        'email',
        'phone',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
