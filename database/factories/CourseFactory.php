<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'start_date' => fake()->dateTimeThisYear(),
            'school_id' => School::factory(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'price' => fake()->randomNumber(4),
            'currency' => 'PLN',
        ];
    }
}
