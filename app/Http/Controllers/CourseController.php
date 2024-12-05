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
    public function __construct(protected CourseService $courseService) {}

    public function index(): CourseCollection
    {
        return new CourseCollection(
            Course::query()
                ->with(['school', 'category'])
                ->paginate()
        );
    }

    public function store(StoreCourseRequest $request): CourseResource
    {
        return new CourseResource($this->courseService->create($request->getCourse())->load(['school']));
    }

    public function show(Course $course): CourseResource
    {
        return new CourseResource($course->load(['school']));
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
