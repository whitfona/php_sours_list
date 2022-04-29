<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_screen_can_be_rendered()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('users.edit', $user));

        $response->assertStatus(200);
    }

    // TODO: MAKE THIS TEST BETTER
    public function test_authenticated_user_can_update_their_profile_name()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patch(route('users.update', $user), ['name' => 'Nick'])
            ->assertRedirect(route('users.edit', $user));

        $this->assertArrayHasKey('name', User::all()->first()->toArray());
        $this->assertContains('Nick', User::all()->first()->toArray());
    }

    public function test_authenticated_user_can_update_their_profile_email()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patch(route('users.update', $user), ['email' => 'nick@is.cool'])
            ->assertRedirect(route('users.edit', $user));

        $this->assertArrayHasKey('email', User::all()->first()->toArray());
        $this->assertContains('nick@is.cool', User::all()->first()->toArray());
    }

    public function test_authenticated_user_can_update_their_profile_image()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patch(route('users.update', $user), ['profileImage' => UploadedFile::fake()->image('test.png')])
            ->assertRedirect(route('users.edit', $user));

        $this->assertArrayHasKey('profileImage', User::all()->first()->toArray());
        $this->assertNotNull(User::all()->first()->profileImage);
    }

    public function test_unauthenticated_user_can_not_update_a_profile()
    {
        $user = User::factory()->create();

        $this->patch(route('users.update', $user), ['name' => 'Nick']);

        $this->assertGuest();
    }

    public function test_email_must_be_unique_to_other_users()
    {
        User::factory()->create(['email' => 'test@test.com']);
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patchJson(route('users.update', $user), [
            'email' => 'test@test.com'
        ])
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => [
                    "email" => [
                        "The email has already been taken."
                    ]
                ]
                ,
                "message" => "The given data was invalid."
            ]);
    }

    public function test_email_can_be_users_original_email()
    {
        $user = User::factory()->create(['email' => 'test@test.com']);
        $this->actingAs($user);

        $this->patchJson(route('users.update', $user), [
            'email' => 'test@test.com'
        ])
            ->assertRedirect(route('users.edit', $user));
    }

    /**
     * @dataProvider InvalidUserUpdateData
     */
    public function test_error_thrown_with_invalid_inputs($attribute, $attributeValue, $errorMessage)
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->patchJson(route('users.update', $user), [
            $attribute => $attributeValue
            ])
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => $errorMessage
            ,
            "message" => "The given data was invalid."
            ]);
    }

    public function InvalidUserUpdateData()
    {
        return [
            'name cannot be null' => [
                'attribute' => 'name',
                'attributeValue' => null,
                'errorMessage' => [
                    "name" => [
                        "The name field is required."
                    ]
                ]
            ],
            'name must be a string' => [
                'attribute' => 'name',
                'attributeValue' => [-1],
                'errorMessage' => [
                    "name" => [
                        "The name must be a string."
                    ]
                ]
            ],
            'name must be less than 255 characters' => [
                'attribute' => 'name',
                'attributeValue' => str_repeat('a', 256),
                'errorMessage' => [
                    "name" => [
                        "The name must not be greater than 255 characters."
                    ]
                ]
            ],
            'email must not be null' => [
                'attribute' => 'email',
                'attributeValue' => null,
                'errorMessage' => [
                    "email" => [
                        "The email field is required."
                    ]
                ]
            ],
            'email must be a string' => [
                'attribute' => 'email',
                'attributeValue' => [-1],
                'errorMessage' => [
                    "email" => [
                        'The email must be a string.',
                        'The email must be a valid email address.'
                    ]
                ]
            ],
            'email must be an email' => [
                'attribute' => 'email',
                'attributeValue' => 'notanemail',
                'errorMessage' => [
                    "email" => [
                        'The email must be a valid email address.'
                    ]
                ]
            ],
            'email must be less than 255 characters' => [
                'attribute' => 'email',
                'attributeValue' => str_repeat('a', 256) . 'test@gmail.com',
                'errorMessage' => [
                    "email" => [
                        "The email must not be greater than 255 characters."
                    ]
                ]
            ],
            'image must be of type: heic, jpg, jpeg, png, bmp, gif, svg, webp.' => [
                'attribute' => 'profileImage',
                'attributeValue' => 'test',
                'errorMessage' => [
                    "profileImage" => [
                        "The profile image must be a file of type: heic, jpg, jpeg, png, bmp, gif, svg, webp."
                    ]
                ]
            ],
            'image must be less than 5MB' => [
                'attribute' => 'profileImage',
                'attributeValue' => UploadedFile::fake()->create('image.png', 5001),
                'errorMessage' => [
                    "profileImage" => [
                        "The profile image must not be greater than 5000 kilobytes."
                    ]
                ]
            ],
        ];
    }
}
