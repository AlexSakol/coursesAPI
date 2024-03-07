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
}
