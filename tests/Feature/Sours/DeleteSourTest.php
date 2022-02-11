<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class DeleteSourTest extends TestCase
{
    use RefreshDatabase;

    public function test_sour_can_be_deleted()
    {
        $this->actingAs(User::factory()->create());

        $sour = Sour::factory()->create();

        $this->assertEquals($sour->toArray(), Sour::all()->first()->toArray());
        $this->assertDatabaseCount('sours', 1);

        $this->deleteJson(route('sours.delete', $sour), $sour->toArray());

        $this->assertDatabaseCount('sours', 0);
    }

    public function test_sour_cannot_be_deleted_by_unauthenticated_user()
    {
        $sour = Sour::factory()->create();

        $this->assertEquals($sour->toArray(), Sour::all()->first()->toArray());
        $this->assertDatabaseCount('sours', 1);

        $this->deleteJson(route('sours.delete', $sour), $sour->toArray());

        $this->assertGuest();

    }
}
