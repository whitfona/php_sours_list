<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
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
        $user = User::factory()->create();
        $this->actingAs($user);

        $attributes = [
            'company' => 'Fixed Gear Brewing',
            'name' => 'Cherry Training Wheels',
            'percent' => 4.0,
            'comments' => 'Cherry Training Wheels is soured with our lactobacillus blend to generate a tart lactic acidity, then hopped generously with North American hops to bring out notes of lemon peel. Blended with fresh cherry juice and pours a beautiful pink.',
            'rating' => 9,
            'hasLactose' => true,
            'category' => 1
        ];

        $this->postJson(route('sours.store'), $attributes)
            ->assertRedirect(route('sours.index'));

        $this->assertDatabaseCount('sours', 1);
    }

    public function test_user_cannot_add_sour_they_have_already_added()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $sour = Sour::factory()->create(['user_id' => $user->id]);
        $secondSour = Sour::factory()->raw([
            'user_id' => $user->id,
            'name' => $sour->name
        ]);

        $this->postJson(route('sours.store'), $secondSour)
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => [
                    "name" => [
                        "That bevvie has already been rated!"
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
            'rating cannot be null' => [
                'invalidAttribute' => $this->setInvalidAttribute('rating', null),
                'errorMessage' => [
                    'rating' => [
                        'The rating field is required.'
                    ]
                ],
            ],
            'rating must be a number' => [
                'invalidAttribute' => $this->setInvalidAttribute('rating', 'hello'),
                'errorMessage' => [
                    'rating' => [
                        'The rating must be a number.',
                        'The rating must be greater than or equal to 0.',
                        'The rating must be less than or equal to 10.',
                    ]
                ],
            ],
            'rating must greater than or equal to 0' => [
                'invalidAttribute' => $this->setInvalidAttribute('rating', -1),
                'errorMessage' => [
                    'rating' => [
                        'The rating must be greater than or equal to 0.'
                    ]
                ],
            ],
            'rating must be less than or equal to 10' => [
                'invalidAttribute' => $this->setInvalidAttribute('rating', 11),
                'errorMessage' => [
                    'rating' => [
                        'The rating must be less than or equal to 10.'
                    ]
                ],
            ],
            'image must be jpg, jpeg, png, bmp, gif, svg, or webp' => [
                'invalidAttribute' => $this->setInvalidAttribute('image', UploadedFile::fake()->create('test.pdf', 0, 'pdf')),
                'errorMessage' => [
                    'image' => [
                        "The image must be a file of type: heic, jpg, jpeg, png, bmp, gif, svg, webp."
                    ]
                ],
            ],
            'image must be less than 3 MB' => [
                'invalidAttribute' => $this->setInvalidAttribute('image', UploadedFile::fake()->create('test.png', 5001)),
                'errorMessage' => [
                    'image' => [
                        'The image must not be greater than 5000 kilobytes.'
                    ]
                ],
            ],
            'category id must be a number' => [
                'invalidAttribute' => $this->setInvalidAttribute('category_id', 'hello'),
                'errorMessage' => [
                    'category_id' => [
                        'The category id must be a number.',
                        'The category id must be greater than or equal to 0.'
                    ]
                ],
            ],
            'category id must be greater than or equal to zero' => [
                'invalidAttribute' => $this->setInvalidAttribute('category_id', -3),
                'errorMessage' => [
                    'category_id' => [
                        'The category id must be greater than or equal to 0.'
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
