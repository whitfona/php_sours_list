<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->get(route('users.edit', $user));

        $response->assertStatus(200);
    }

    public function test_authenticated_user_can_update_their_profile()
    {
        $user = User::factory()->create();

        $this->patch(route('update-user', $user), ['name' => 'Nick'])
            ->assertOk();
    }

    public function test_unauthenticated_user_can_not_update_a_profile()
    {
        $user = User::factory()->create();

        $this->patch(route('update-user', $user), ['name' => 'Nick']);

        $this->assertGuest();
    }
}
