<?php

namespace Database\Seeders;

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
        $user = User::factory()->create([
            'name' => 'Nick',
            'email' => 'whitford_4@hotmail.com',
            'password' => Hash::make('Passw0rd!'),
        ]);

        //create 3 sours for user 1
        Sour::factory(3)->create(['user_id' => $user->id]);
        // create 10 other random sours
        Sour::factory(10)->create();
    }
}
