<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseCollection;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CourseController extends Controller
{
    public function __construct(protected CourseService $courseService) {}

    public function index(): CourseCollection
    {
        $courses = QueryBuilder::for(Course::class)
            ->allowedFilters(AllowedFilter::partial('school.name'),
                AllowedFilter::exact('school.city'),
                AllowedFilter::exact('category.name')
            )
            ->allowedSorts(['price', 'start_date'])
            ->with(['school', 'category'])
            ->paginate(10);

        return new CourseCollection($courses);
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

    public function locations()
    {
        $cities = Course::query()
            ->join('schools', 'courses.school_id', '=', 'schools.id')
            ->distinct()
            ->pluck('schools.city');

        return response()->json($cities);
    }
}
