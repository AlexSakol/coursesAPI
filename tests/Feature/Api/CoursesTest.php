<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CoursesTest extends TestCase
{
    public function can_get_all_courses()
    {
        $course = Course::factory->create();

        $responce = $this->getJson(route('api.courses.index'));
        $responce->assertOk();
    }
}
