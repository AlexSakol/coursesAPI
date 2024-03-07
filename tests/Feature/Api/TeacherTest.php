<?php

namespace Api;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherTest extends TestCase
{
    use RefreshDatabase;
    public function test_can_get_all_teachers(): void
    {
        $teacher = Teacher::factory()->create();

        $response = $this->getJson(route('teachers.index'));
        $response->assertOk();

        $response->assertJson([
            'data' =>[
                [
                    'id' => $teacher->id,
                    'name' => $teacher->name,
                    'description' => $teacher->description
                ]
            ]
        ]);
    }

    public function test_can_store_a_teacher(): void
    {
        $newTeacher = Teacher::factory()->make();

        $response = $this->postJson(route('teachers.store'), $newTeacher->toArray());
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'name' => $newTeacher->name
            ]
        ]);

        $this->assertDatabaseHas('teachers', $newTeacher->toArray());
    }

    public function test_can_update_a_teacher(): void
    {
        $oldTeacher = Teacher::factory()->create();
        $newTeacher = Teacher::factory()->make();

        $response = $this->putJson(route('teachers.update', $oldTeacher),
            $newTeacher->toArray());

        $response->assertJson([
            'data' =>[
                'id' => $oldTeacher->id,
                'name' => $newTeacher->name
            ]
        ]);

        $this->assertDatabaseHas('teachers', $newTeacher->toArray());
    }
}
