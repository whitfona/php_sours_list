<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class DeleteSourTest extends TestCase
{
    use RefreshDatabase;

    public function test_sour_can_be_deleted()
    {
        $sour = Sour::factory()->create();

        $this->assertEquals($sour->toArray(), Sour::all()->first()->toArray());
        $this->assertDatabaseCount('sours', 1);

        $this->deleteJson(route('sours.delete', $sour), $sour->toArray());

        $this->assertDatabaseCount('sours', 0);

    }
}
