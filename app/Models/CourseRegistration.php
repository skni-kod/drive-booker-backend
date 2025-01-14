<?php

namespace App\Models;

use App\Enums\RegistrationStatus;
use Database\Factories\CourseRegistrationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    /** @use HasFactory<CourseRegistrationFactory> */
    use HasFactory;
    protected $fillable = [
        'course_id',
        'user_id',
        'status',
    ];

    protected $casts = [
        'status' => RegistrationStatus::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
