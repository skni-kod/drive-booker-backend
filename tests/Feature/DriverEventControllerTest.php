<?php

namespace Tests\Feature;

use App\Enums\EventsEnum;
use App\Enums\RolesEnum;
use App\Models\Category;
use App\Models\Course;
use App\Models\Event;
use App\Models\School;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DriverEventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_driver_events_can_be_filtered_by_status_and_current_week(): void
    {
        Role::findOrCreate(RolesEnum::DRIVER->value, 'web');

        $category = Category::unguarded(fn () => Category::create(['name' => 'B']));
        $school = School::factory()->create(['address' => 'Testowa 1']);

        $course = Course::create([
            'start_date' => Carbon::today()->toDateString(),
            'school_id' => $school->id,
            'category_id' => $category->id,
            'price' => 3000,
            'currency' => 'PLN',
        ]);

        $driver = User::factory()->create();
        $driver->forceFill(['course_id' => $course->id])->save();
        $driver->assignRole(RolesEnum::DRIVER->value);

        $instructor = User::factory()->create();

        $weekStart = Carbon::now()->startOfWeek(Carbon::MONDAY);
        $acceptedCurrentStart = $weekStart->copy()->addDay()->setTime(10, 0);
        $pendingCurrentStart = $weekStart->copy()->addDays(2)->setTime(12, 0);
        $acceptedNextWeekStart = $weekStart->copy()->addWeek()->addDay()->setTime(9, 0);

        $acceptedCurrentEvent = Event::create([
            'driver_id' => $driver->id,
            'instructor_id' => $instructor->id,
            'title' => 'Jazda zaakceptowana',
            'start' => $acceptedCurrentStart,
            'end' => $acceptedCurrentStart->copy()->addHour(),
            'status' => EventsEnum::ACCEPTED->value,
        ]);

        Event::create([
            'driver_id' => $driver->id,
            'instructor_id' => $instructor->id,
            'title' => 'Jazda oczekujaca',
            'start' => $pendingCurrentStart,
            'end' => $pendingCurrentStart->copy()->addHour(),
            'status' => EventsEnum::PENDING->value,
        ]);

        Event::create([
            'driver_id' => $driver->id,
            'instructor_id' => $instructor->id,
            'title' => 'Jazda w przyszlym tygodniu',
            'start' => $acceptedNextWeekStart,
            'end' => $acceptedNextWeekStart->copy()->addHour(),
            'status' => EventsEnum::ACCEPTED->value,
        ]);

        Sanctum::actingAs($driver);

        $response = $this->getJson('/api/driver/events?status=accepted&week=current');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.id', $acceptedCurrentEvent->id);
        $response->assertJsonPath('data.0.status', EventsEnum::ACCEPTED->value);
        $response->assertJsonPath('data.0.location', $school->address);
    }
}
