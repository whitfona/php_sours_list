<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Sour;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CategoryTest extends TestCase
{

    use RefreshDatabase;

    public function test_add_category_to_database()
    {
        $this->assertDatabaseCount('categories', 0);

        Category::factory()->create();

        $this->assertDatabaseCount('categories', 1);
    }

    public function test_category_belongs_to_a_sour()
    {
        $category = Category::factory()->create();

        $this->assertInstanceOf( Sour::class, $category->sour);
    }
}
