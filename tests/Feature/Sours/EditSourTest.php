<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditSourTest extends TestCase
{
    use RefreshDatabase;

    public function test_sour_can_be_edited()
    {
        $this->actingAs(User::factory()->create());

        $sour = Sour::factory()->create();

        $this->patchJson(route('sours.update', $sour), [
            'company' => 'Nick Test Company',
            'name' => 'Nick Test Name',
            'percent' => 6.9,
            'comments' => 'Updated comments',
            'rating' => 10,
            'hasLactose' => true
            ]);

        $sour['company'] = 'Nick Test Company';
        $sour['name'] = 'Nick Test Name';
        $sour['percent'] = 6.9;
        $sour['comments'] = 'Updated comments';
        $sour['rating'] = 10;
        $sour['hasLactose'] = true;

        $this->assertEquals($sour->toArray(), Sour::all()->first()->toArray());
    }

    public function test_sour_cannot_be_edited_by_unauthenticated_user()
    {
        $sour = Sour::factory()->create();

        $this->patchJson(route('sours.update', $sour), [
            'company' => 'Nick Test Company',
        ]);

        $sour['company'] = 'Nick Test Company';

        $this->assertGuest();
    }

    public function test_error_thrown_if_updated_name_is_not_unique()
    {
        $this->actingAs(User::factory()->create());
        $sour = Sour::factory()->create(['name' => 'Not a unique name']);
        $sourToUpdate = Sour::factory()->create();

        $this->patchJson(route('sours.update', $sourToUpdate), [
            'name' => 'Not a unique name'
        ])->assertUnprocessable()
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
     * @dataProvider InvalidUpdateData
     */
    public function test_error_thrown_with_invalid_value($attribute, $attributeValue, $errorMessage)
    {
        $this->actingAs(User::factory()->create());
        $sour = Sour::factory()->create();

        $attributeToUpdate = [$attribute => $attributeValue];

        $this->patchJson(route('sours.update', $sour), $attributeToUpdate)
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => $errorMessage,
                "message" => "The given data was invalid."
            ]);
    }

    public function InvalidUpdateData()
    {
        return [
            'company is required' => [
                'attribute' => 'company',
                'attributeValue' => null,
                'errorMessage' => [
                    "company" => [
                        "The company field is required."
                    ]
                ]
            ],
            'company must be a string' => [
                'attribute' => 'company',
                'attributeValue' => [-1.4],
                'errorMessage' => [
                    "company" => [
                        "The company must be a string."
                    ]
                ]
            ],
            'company must be less than 100 characters' => [
                'attribute' => 'company',
                'attributeValue' => Str::repeat('a', 101),
                'errorMessage' => [
                    "company" => [
                        "The company must not be greater than 100 characters."
                    ]
                ]
            ],
            'name is required' => [
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
                'attributeValue' => [-1.4],
                'errorMessage' => [
                    "name" => [
                        "The name must be a string."
                    ]
                ]
            ],
            'name must be less than 100 characters' => [
                'attribute' => 'name',
                'attributeValue' => Str::repeat('a', 101),
                'errorMessage' => [
                    "name" => [
                        "The name must not be greater than 100 characters."
                    ]
                ]
            ],
            'percent must a number' => [
                'attribute' => 'percent',
                'attributeValue' => 'Not a number',
                'errorMessage' => [
                    "percent" => [
                        "The percent must be a number.",
                        "The percent must be greater than or equal to 0."
                    ]
                ]
            ],
            'percent must a greater or equal to zero' => [
                'attribute' => 'percent',
                'attributeValue' => -6.9,
                'errorMessage' => [
                    "percent" => [
                        "The percent must be greater than or equal to 0."
                    ]
                ]
            ],
            'comments must a string' => [
                'attribute' => 'comments',
                'attributeValue' => [-6.9],
                'errorMessage' => [
                    "comments" => [
                        "The comments must be a string."
                    ]
                ]
            ],
            'comments can be a max of 280 characters' => [
                'attribute' => 'comments',
                'attributeValue' => Str::repeat('a', 281),
                'errorMessage' => [
                    "comments" => [
                        "The comments must not be greater than 280 characters."
                    ]
                ]
            ],
            'rating must be a number' => [
                'attribute' => 'rating',
                'attributeValue' => [6.9],
                'errorMessage' => [
                    "rating" => [
                        "The rating must be a number.",
                        "The rating must be greater than or equal to 0."
                    ]
                ]
            ],
            'rating must be greater than or equal to zero' => [
                'attribute' => 'rating',
                'attributeValue' => -6.9,
                'errorMessage' => [
                    "rating" => [
                        "The rating must be greater than or equal to 0."
                    ]
                ]
            ]
        ];
    }
}
