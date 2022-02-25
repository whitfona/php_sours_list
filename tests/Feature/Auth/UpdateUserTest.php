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

    // TODO: MAKE THIS TEST BETTER
    public function test_authenticated_user_can_update_their_profile()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patch(route('users.update', $user), ['name' => 'Nick'])
            ->assertOk();

        $this->assertContains('Nick', User::all()->first()->toArray());
    }

    public function test_unauthenticated_user_can_not_update_a_profile()
    {
        $user = User::factory()->create();

        $this->patch(route('users.update', $user), ['name' => 'Nick']);

        $this->assertGuest();
    }

    /**
     * @dataProvider InvalidUserUpdateData
     */
    public function test_error_thrown_with_invalid_inputs($attribute, $attributeValue)
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patchJson(route('users.update', $user), [
            $attribute => $attributeValue
            ])
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => [
                "name" => [
                    "The name field is required."
                ]
            ],
            "message" => "The given data was invalid."
            ]);
    }

    public function InvalidUserUpdateData()
    {
        return [
            'name cannot be null' => [
                'attribute' => 'name',
                'attributeValue' => null
            ]
        ];
    }
}
