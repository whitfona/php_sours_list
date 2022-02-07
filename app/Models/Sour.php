<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sour extends Model
{
    use HasFactory;

    protected $fillable = ['company', 'name', 'percent', 'comments', 'rating', 'hasLactose'];

    public function store()
    {
        $validated = request()->validate([
            'company' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'unique:sours,name', 'max:100'],
            'percent' => ['numeric', 'gte:0'],
            'comments' => ['string', 'max:280'],
            'rating' => ['numeric', 'gte:0'],
            'hasLactose' => ['boolean'],
        ],
            [ 'name.unique' => 'That sour has already been rated!', ]
        );

        Sour::create($validated);

        return redirect('/dashboard')->with([
            'type' => 'success',
            'message' => 'Your new sour was successfully added!'
        ]);
    }

    public function destory(Sour $sour)
    {
        $sour->delete();

        return redirect('/dashboard')->with([
            'type' => 'success',
            'message' => 'The sour was successfully deleted!'
        ]);
    }

    protected $casts = [
        'hasLactose' => 'boolean',
    ];

}
