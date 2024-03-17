<?php

namespace Http\Requests;

use Tests\TestCase;
use App\Models\Teacher;
use Illuminate\Support\Str;

class TeacherRequestTest extends TestCase
{

    public function test_name_is_required(): void
    {
        $validatedField = 'name';
        $brokenValue = null;

        $teacher = Teacher::factory()->make(
            [$validatedField => $brokenValue]
        );

        $this->postJson(
            route('teachers.index'),
            $teacher->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('teachers.store'),
            $teacher->toArray()
        )->assertJsonValidationErrors($validatedField);

        $oldTeacher = Teacher::factory()->create();
        $newTeacher = Teacher::factory()->make(
            [$validatedField => $brokenValue]
        );

        $this->putJson(
            route('teachers.update', $oldTeacher),
            $newTeacher->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    public function test_name_is_255_characters_max(): void
    {
        $validatedField = 'name';
        $brokenValue = Str::random(256);

        $teacher = Teacher::factory()->make(
            [$validatedField => $brokenValue]
        );

        $this->postJson(
            route('teachers.index'),
            $teacher->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('teachers.store'),
            $teacher->toArray()
        )->assertJsonValidationErrors($validatedField);

        $oldTeacher = Teacher::factory()->create();
        $newTeacher = Teacher::factory()->make(
            [$validatedField => $brokenValue]
        );

        $this->putJson(
            route('teachers.update', $oldTeacher),
            $newTeacher->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}
