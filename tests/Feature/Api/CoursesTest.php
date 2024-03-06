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

        $response = $this->getJson(route('api.courses.index'));
        $response->assertOk();

        $response->assertJson([
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

    public function test_can_store_a_course()
    {
        $newCourse = Course::factory()->make();

        $response = $this->postJson(
            route('api.courses.store'),
            $newCourse->toArray()
        );
        $response->assertCreated();
        $response->assertJson([
           'data' => [
               'name' => $newCourse->name
           ]
        ]);
        $this->assertDatabaseHas(
            'courses',
            $newCourse->toArray()
        );
    }

    public function test_can_update_a_course()
    {
        $existingCourse = Course::factory()->create();
        $newCourse = Course::factory()->make();

        $response = $this->putJson(
            route('api.courses.update', $existingCourse),
            $newCourse->toArray()
        );
        $response->assertJson([
            'data' => [
                'id' => $existingCourse->id,
                'name' => $newCourse->name
            ]
        ]);

        $this->assertDatabaseHas(
            'courses',
            $newCourse->toArray()
        );
    }

    public function test_can_delete_a_course()
    {
        $existingCourse = Course::factory()->create();

        $this->deleteJson(
            route('api.courses.destroy', $existingCourse)
        )->assertNoContent();

        $this->assertDatabaseMissing(
            'courses',
            $existingCourse->toArray()
        );
    }
}
