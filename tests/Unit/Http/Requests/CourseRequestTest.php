<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use App\Models\Course;
use Illuminate\Support\Str;

class CourseRequestTest extends TestCase
{
    private string $routePrefix = 'api.courses.';

    /**
     * A basic unit test example.
     */
    public function test_name_is_required(): void
    {
        $validatedField = 'name';
        $brokenRule = null;

        $course = Course::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $course->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    public function test_name_must_be_255_characters_max(): void
    {
        $validatedField = 'name';
        $brokenRule = Str::random(256);

        $course = Course::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $course->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    public function test_price_is_required(): void
    {
        $validatedField = 'price';
        $brokenRule = null;

        $course = Course::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $course->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
    public function test_price_is_integer(): void
    {
        $validatedField = 'price';
        $brokenRule = 'not-integer';

        $course = Course::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route($this->routePrefix . 'store'),
            $course->toArray()
        )->assertJsonValidationErrors($validatedField);
    }
}