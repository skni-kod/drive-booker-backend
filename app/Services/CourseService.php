<?php

namespace App\Services;

use App\Models\Course;
use App\ValueObjects\CreateNewCourse;

class CourseService
{
    public function create(CreateNewCourse $course): Course
    {
        return Course::create($course->toArray());
    }

    public function delete(Course $course): bool
    {
        return $course->delete();
    }
}
