<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomNumber(6),
            'description' => $this->faker->paragraph,
            'category_id' => Category::factory(),
            'teacher_id' => Teacher::factory()
        ];
    }
}
