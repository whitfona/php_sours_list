<?php

namespace Tests\Feature\Sours;

use App\Models\Sour;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class EditSourTest extends TestCase
{
    use RefreshDatabase;

    public function test_sour_can_be_edited()
    {
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

    /**
     * @dataProvider InvalidUpdateData
     */
    public function test_error_thrown_with_invalid_value($attribute, $attributeValue, $errorMessage)
    {
        $sour = Sour::factory()->create();

        $attributeToUpdate = [$attribute => $attributeValue];

        $this->patchJson(route('sours.update', $sour), $attributeToUpdate)
            ->assertUnprocessable()
            ->assertExactJson([
                "errors" => $errorMessage,
                "message" => "The given data was invalid."
            ]);

        $sour[$attribute] = $attributeValue;
    }

    public function InvalidUpdateData()
    {
        return [
            'name is required' => [
                'attribute' => 'name',
                'attributeValue' => null,
                'errorMessage' => [
                    "name" => [
                        "The name field is required."
                    ]
                ]
            ]
        ];
    }
}
