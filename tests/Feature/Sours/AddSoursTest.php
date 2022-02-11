<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AddSoursTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthenticated_user_cannot_add_sour()
    {
        $attributes = [
            'company' => 'Fixed Gear Brewing',
            'name' => 'Cherry Training Wheels',
            'percent' => 4.0,
            'comments' => 'Cherry Training Wheels is soured with our lactobacillus blend to generate a tart lactic acidity, then hopped generously with North American hops to bring out notes of lemon peel. Blended with fresh cherry juice and pours a beautiful pink.',
            'rating' => 9,
            'hasLactose' => true,
        ];

        $this->postJson(route('sours.store'), $attributes);

        $this->assertGuest();
    }

    public function test_new_sour_can_be_added_by_authenticated_user()
    {
        $this->actingAs(User::factory()->create());

        $attributes = [
            'company' => 'Fixed Gear Brewing',
            'name' => 'Cherry Training Wheels',
            'percent' => 4.0,
            'comments' => 'Cherry Training Wheels is soured with our lactobacillus blend to generate a tart lactic acidity, then hopped generously with North American hops to bring out notes of lemon peel. Blended with fresh cherry juice and pours a beautiful pink.',
            'rating' => 9,
            'hasLactose' => true,
        ];

        $this->postJson(route('sours.store'), $attributes);

        $this->assertDatabaseHas('sours', $attributes);

    }

    public function test_new_sour_has_unique_name()
    {
        $this->actingAs(User::factory()->create());

        $sour = Sour::factory()->create();
        $secondSour = Sour::factory()->raw(['name' => $sour->name]);

        $this->postJson(route('sours.store'), $secondSour)
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => [
                    "name" => [
                        "That sour has already been rated!"
                    ]
                ],
                "message" => "The given data was invalid."
            ]);
    }

    /**
     * @dataProvider invalidDataAddSour
     */
    public function test_add_invalid_sour_cannot_be_added($invalidAttribute, $errorMessage)
    {
        $this->actingAs(User::factory()->create());

        $this->postJson(route('sours.store'), $invalidAttribute)
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => $errorMessage,
                "message" => "The given data was invalid."
            ]);
    }

    public function invalidDataAddSour()
    {
        return [
            'company cannot be null' => [
                'invalidAttribute' => $this->setInvalidAttribute('company', null),
                'errorMessage' => [
                    'company' => [
                        'The company field is required.'
                    ]
                ],
            ],
            'company must be a string' => [
                'invalidAttribute' => $this->setInvalidAttribute('company', [-1.5]),
                'errorMessage' => [
                    'company' => [
                        'The company must be a string.'
                    ]
                ],
            ],
            'company cannot be longer than 100 characters' => [
                'invalidAttribute' => $this->setInvalidAttribute('company', Str::repeat('a', 101)),
                'errorMessage' => [
                    'company' => [
                        'The company must not be greater than 100 characters.'
                    ]
                ],
            ],
            'name cannot be null' => [
                'invalidAttribute' => $this->setInvalidAttribute('name', null),
                'errorMessage' => [
                    'name' => [
                        'The name field is required.'
                    ]
                ],
            ],
            'name cannot be longer than 100 characters' => [
                'invalidAttribute' => $this->setInvalidAttribute('name', Str::repeat('a', 101)),
                'errorMessage' => [
                    'name' => [
                        'The name must not be greater than 100 characters.'
                    ]
                ],
            ],
            'name must be a string' => [
                'invalidAttribute' => $this->setInvalidAttribute('name', [-1.5]),
                'errorMessage' => [
                    'name' => [
                        'The name must be a string.'
                    ]
                ],
            ],
            'percent must be a number' => [
                'invalidAttribute' => $this->setInvalidAttribute('percent', 'hello'),
                'errorMessage' => [
                    'percent' => [
                        'The percent must be a number.',
                        'The percent must be greater than or equal to 0.'
                    ]
                ],
            ],
            'percent must greater than or equal to 0' => [
                'invalidAttribute' => $this->setInvalidAttribute('percent', -4),
                'errorMessage' => [
                    'percent' => [
                        'The percent must be greater than or equal to 0.'
                    ]
                ],
            ],
            'comments must be a string' => [
                'invalidAttribute' => $this->setInvalidAttribute('comments', [-4.6]),
                'errorMessage' => [
                    'comments' => [
                        'The comments must be a string.'
                    ]
                ],
            ],
            'comments must be less than 280 characters' => [
                'invalidAttribute' => $this->setInvalidAttribute('comments', Str::repeat('a', 281)),
                'errorMessage' => [
                    'comments' => [
                        'The comments must not be greater than 280 characters.'
                    ]
                ],
            ],
            'rating must be a number' => [
                'invalidAttribute' => $this->setInvalidAttribute('rating', 'hello'),
                'errorMessage' => [
                    'rating' => [
                        'The rating must be a number.',
                        'The rating must be greater than or equal to 0.'
                    ]
                ],
            ],
            'rating must greater than or equal to 0' => [
                'invalidAttribute' => $this->setInvalidAttribute('rating', -4),
                'errorMessage' => [
                    'rating' => [
                        'The rating must be greater than or equal to 0.'
                    ]
                ],
            ],
            'hasLactose must a boolean' => [
                'invalidAttribute' => $this->setInvalidAttribute('hasLactose', 'hello'),
                'errorMessage' => [
                    'hasLactose' => [
                        'The has lactose field must be true or false.'
                    ]
                ],
            ],
    ];
    }

    /**
     * @return array
     */
    public function setInvalidAttribute($attribute, $attributeValue): array
    {
        $sour = [
            'company' => 'Fixed Gear Brewing',
            'name' => 'Cherry Training Wheels',
            'percent' => 4.0,
            'comments' => 'Cherry Training Wheels is soured with our lactobacillus blend to generate a tart lactic acidity, then hopped generously with North American hops to bring out notes of lemon peel. Blended with fresh cherry juice and pours a beautiful pink.',
            'rating' => 9,
            'hasLactose' => true
        ];

        $sour[$attribute] = $attributeValue;
        return $sour;
    }
}
