<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_categories(): void
    {
        $category = Category::factory()->create();

        $response = $this->getJson(route('categories.index'));
        $response->assertOk();

        $response->assertJson([
            'data' => [
                [
                'id' => $category->id,
                'name' => $category->name
                ]
            ]
        ]);
    }

    public function test_can_store_a_category(): void
    {
        $newCategory = Category::factory()->make();

        $response = $this->postJson(
            route('categories.store'),
            $newCategory->toArray()
        );
        $response->assertCreated();
        $response->assertJson([
            'data' => [
                'name' => $newCategory->name
            ]
        ]);
        $this->assertDatabaseHas(
            'categories',
            $newCategory->toArray()
        );
    }

    public function test_can_update_a_category(): void
    {
        $oldCategory = Category::factory()->create();
        $newCategory = Category::factory()->make();

        $response = $this->putJson(route('categories.update', $oldCategory),
            $newCategory->toArray()
       );
        $response->assertJson([
            'data' => [
                'id' => $oldCategory->id,
                'name' => $newCategory->name
            ]
        ]);
        $this->assertDatabaseHas(
            'categories',
            $newCategory->toArray()
        );
    }

    public function test_can_destroy_a_category(): void
    {
        $existingCategory = Category::factory()->create();
        $this->deleteJson(route('categories.destroy', $existingCategory),
        [
            'data' => $existingCategory
        ])->assertNoContent();
        $this->assertDatabaseMissing('categories', $existingCategory->toArray());
    }
}
