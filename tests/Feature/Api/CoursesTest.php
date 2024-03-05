<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Course;

class CoursesTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_courses()
    {
        $course = Course::factory()->create();

        $responce = $this->getJson(route('api.courses.index'));
        $responce->assertOk();

        $responce->assertJson([
            'data' => [
                [
                    'id' => $course->id,
                    'name' => $course->name,
                    'price' => $course->price,
                    'description' => $course->description,
                    'category' => $course->category
                ]
            ]
        ]);
    }
}
