<?php

namespace App\Http\Controllers;

use App\Models\Sour;

class SourController extends Controller
{
    public function store()
    {
        $validated = request()->validate([
            'company' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', 'unique:sours,name', 'max:100'],
            'percent' => ['sometimes', 'numeric', 'gte:0', 'nullable'],
            'comments' => ['sometimes', 'string', 'max:280', 'nullable'],
            'rating' => ['required', 'numeric', 'gte:0', 'nullable'],
        ],
            [ 'name.unique' => 'That sour has already been rated!', ]
        );

        $validated['hasLactose'] = request()->has('hasLactose');

        auth()->user()->sours()->create($validated);

        return redirect(route('sours.index'))->with([
            'type' => 'success',
            'message' => 'Your new sour was successfully added!'
        ]);
    }

    public function index()
    {
        $sours = auth()->user()->sours->sortByDesc('rating');

        return view('my-sours', compact('sours'));
    }

    public function all()
    {
        $sours = Sour::all();

        return view('all-sours', compact('sours'));
    }

    public function show(Sour $sour)
    {
        if (auth()->user()->isNot($sour->user)){
            abort(403);
        }

        return view('sours.show', compact('sour'));
    }

    public function update(Sour $sour)
    {
        $validated = request()->validate([
            'company' => ['sometimes', 'required', 'string', 'max:100'],
            'name' => ['sometimes', 'required', 'string', 'unique:sours,name', 'max:100'],
            'percent' => ['sometimes', 'numeric', 'gte:0'],
            'comments' => ['sometimes', 'string', 'max:280'],
            'rating' => ['sometimes', 'numeric', 'gte:0'],
            'hasLactose' => ['sometimes', 'boolean'],
        ],
            [ 'name.unique' => 'That sour has already been rated!', ]
        );

        $sour->update($validated);

        return redirect('/dashboard')->with([
            'type' => 'success',
            'message' => 'The sour was successfully deleted!'
        ]);
    }

    public function destroy(Sour $sour)
    {
        $sour->delete();

        return redirect('/dashboard')->with([
            'type' => 'success',
            'message' => 'The sour was successfully deleted!'
        ]);
    }
}
