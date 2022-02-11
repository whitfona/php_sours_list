<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class GetSoursTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_sour_requires_an_user()
    {
        $attributes = Sour::factory()->raw();

        $this->post(route('sours.store'), $attributes)->assertRedirect('login');
    }

    public function test_get_all_sours_from_database()
    {
        $sours = Sour::factory()->create();

        $this->get(route('sours.index'))
            ->assertSee($sours->all()->first()->company)
            ->assertSee($sours->all()->first()->name)
            ->assertSee($sours->all()->first()->rating)
            ->assertSee($sours->all()->first()->percent)
            ->assertSee($sours->all()->first()->hasLactose)
            ->assertSee($sours->all()->first()->comments);
    }

}
