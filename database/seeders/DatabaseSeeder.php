<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Sour;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
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

        $user = User::factory()->create([
            'name' => 'Nick',
            'email' => 'whitford_4@hotmail.com',
            'password' => Hash::make('Passw0rd!'),
        ]);

        Sour::factory(2)->create([
            'user_id' => $user->id,
            'category_id' => 1
        ]);
        Sour::factory(1)->create([
            'user_id' => $user->id,
            'category_id' => 2
            ]);
        Sour::factory(2)->create(['category_id' => 1]);
        Sour::factory(5)->create(['category_id' => 5]);
        Sour::factory(3)->create(['category_id' => 6]);

    }
}
