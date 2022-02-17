<?php

namespace Tests\Unit;

use App\Models\Sour;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class SoursTest extends TestCase
{

    use RefreshDatabase;

    public function test_sour_belongs_to_a_user()
    {
        $sour = Sour::factory()->create();

        $this->assertInstanceOf( User::class, $sour->user);
    }
}
