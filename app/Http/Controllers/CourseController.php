<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Response;

class CourseController extends Controller
{
    public function __construct(protected CourseService $courseService)
    {
    }

    public function index(): CourseCollection
    {
        return new CourseCollection(Course::query()->paginate());
    }

    public function store(StoreCourseRequest $request): CourseResource
    {
        return new CourseResource($this->courseService->create($request->getCourse()));
    }

    public function show(Course $course): CourseResource
    {
        return new CourseResource($course);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        //
    }
    
    public function destroy(Course $course): Response
    {
        $this->courseService->delete($course);
        return response()->noContent();
    }
}
