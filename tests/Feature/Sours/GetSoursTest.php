<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class GetSoursTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_view_all_sours()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $guestSour = Sour::factory()->create();
        $userSour = Sour::factory()->create(['user_id' => $user->id]);

        $this->assertDatabaseCount('sours', 2);

        $this->get(route('sours.all'))
            ->assertOk()
            ->assertSee(['name' => $userSour->name])
            ->assertSee(['name' => $guestSour->name]);
    }

    public function test_unauthenticated_user_cannot_view_all_sours()
    {
        $guestSour = Sour::factory()->create();

        $this->assertDatabaseCount('sours', 1);

        $this->get(route('sours.all'))
            ->assertRedirect('login');

        $this->assertGuest();
    }

    public function test_a_sour_requires_an_user()
    {
        $attributes = Sour::factory()->raw();

        $this->post(route('sours.store'), $attributes)->assertRedirect('login');
    }

    public function test_authenticated_user_can_only_view_their_sours()
    {
        $user = User::factory()->create();
        $this->be($user);

        $notUserSour = Sour::factory()->create();
        $userSour = Sour::factory()->create(['user_id' => $user->id]);

        $this->get(route('sours.index'))
            ->assertOk()
            ->assertSee(['name' => $userSour->name])
            ->assertDontSee(['name' => $notUserSour->name]);
    }

    public function test_authenticated_user_can_view_one_of_their_sours()
    {
        $user = User::factory()->create();
        $this->be($user);

        $userSour = Sour::factory()->create(['user_id' => $user->id]);

        $this->get(route('sours.show', $userSour))
            ->assertSee(['name' => $userSour->name])
            ->assertSee(['company' => $userSour->company]);
    }

    public function test_authenticated_user_cannot_view_all_sours_of_others()
    {
        $user = User::factory()->create();
        $this->be($user);
        $sour = Sour::factory()->create();

        $this->get(route('sours.index'))
            ->assertDontSee(['name' => $sour->name])
            ->assertDontSee(['company' => $sour->company]);
    }

    public function test_authenticated_user_cannot_view_one_sour_of_other_user()
    {
        $user = User::factory()->create();
        $this->be($user);
        $sour = Sour::factory()->create();

        $this->get(route('sours.show', $sour))
            ->assertStatus(403);
    }

    public function test_unauthorized_user_cannot_view_sours()
    {
        $this->get(route('sours.index'))
            ->assertRedirect('login');

        $this->assertGuest();
    }

    public function test_unauthenticated_user_cannot_view_one_sour_of_other_user()
    {
         $sour = Sour::factory()->create();

         $this->get(route('sours.show', $sour))
             ->assertRedirect('login');
    }
}
