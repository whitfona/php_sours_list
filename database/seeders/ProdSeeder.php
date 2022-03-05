<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Sour;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProdSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->create(['name' => 'Sour']);
        Category::factory()->create(['name' => 'Ale']);
        Category::factory()->create(['name' => 'Cider']);
        Category::factory()->create(['name' => 'Lager']);
        Category::factory()->create(['name' => 'Porter']);
        Category::factory()->create(['name' => 'Radler']);
        Category::factory()->create(['name' => 'Stout']);
        Category::factory()->create(['name' => 'Wheat']);
    }
}
