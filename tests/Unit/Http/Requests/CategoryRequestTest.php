<?php

namespace Http\Requests;

use App\Models\Category;
use Illuminate\Support\Str;
use Tests\TestCase;

class CategoryRequestTest extends TestCase
{

    public function test_name_is_required(): void
    {
        $validatedField = 'name';
        $brokenRule = null;
        $category = Category::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route('categories.index'),
            $category->toArray()
        )->assertJsonValidationErrors($validatedField);

        $this->postJson(
            route('categories.store'),
            $category->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingCategory = Category::factory()->create();
        $newCategory = Category::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->putJson(
            route('categories.update', $existingCategory),
            $newCategory->toArray()
        )->assertJsonValidationErrors($validatedField);
    }

    public function test_name_must_be_255_characters_max(): void
    {
        $validatedField = 'name';
        $brokenRule = Str::random(256);

        $category = Category::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->postJson(
            route('categories.store'),
            $category->toArray()
        )->assertJsonValidationErrors($validatedField);

        $existingCategory = Category::factory()->create();
        $newCategory = Category::factory()->make([
            $validatedField => $brokenRule
        ]);

        $this->putJson(
            route('categories.update', $existingCategory),
            $newCategory->toArray()
        )->assertJsonValidationErrors($validatedField);

    }
}
