<?php

namespace App\Http\Controllers;

use App\Models\Sour;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class SourController extends Controller
{
    public function store()
    {
        $validated = request()->validate([
            'company' => ['required', 'string', 'max:100'],
            'name' => ['required', 'string', Rule::unique('sours', 'name')->where(function ($query) {
                return $query->where('user_id', Auth()->id());
            }), 'max:100'],
            'percent' => ['sometimes', 'numeric', 'gte:0', 'nullable'],
            'comments' => ['sometimes', 'string', 'max:280', 'nullable'],
            'rating' => ['required', 'numeric', 'gte:0', 'lte:10', 'nullable'],
            'image' => ['sometimes', 'mimes:heic,jpg,jpeg,png,bmp,gif,svg,webp', 'max:5000', 'nullable'],
            'category_id' => ['sometimes', 'numeric', 'gte:0', 'nullable']
        ],
            [ 'name.unique' => 'That bevvie has already been rated!', ]
        );

        $validated['hasLactose'] = request()->has('hasLactose');
        if (request()->has('image')) {
            $validated['image'] = time() . '.' . 'jpg';
            Image::make(request()->file('image'))
                ->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                    })
                ->save(public_path('/storage/sours/') . $validated['image']);
        }

        auth()->user()->sours()->create($validated);

        return redirect(route('sours.index'))->with([
            'success' => 'Your new bevvie was successfully added!'
        ]);
    }

    public function create()
    {
        return view('add-sour-form');
    }

    public function index()
    {
        return view('my-sours', [
            'sours' => auth()->user()->sours()->filter(request(['search', 'category']))->orderBy('rating', 'DESC')->paginate(10),
        ]);
    }

    public function all()
    {
        return view('all-sours', [
            'sours' => Sour::filter(request(['search', 'category', 'connoisseur']))->orderBy('rating', 'DESC')->paginate(10),
        ]);
    }

    public function show(Sour $sour)
    {
        if (auth()->user()->isNot($sour->user)){
            abort(403);
        }

        return view('edit-sour-form', compact('sour'));
    }

    public function update(Sour $sour)
    {
        $validated = request()->validate([
            'company' => ['sometimes', 'required', 'string', 'max:100'],
            'name' => ['sometimes', 'required', 'string', 'max:100', Rule::unique('sours', 'name')->where(function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                 })->ignore($sour->id)],
            'percent' => ['sometimes', 'numeric', 'gte:0', 'nullable'],
            'comments' => ['sometimes', 'string', 'max:280', 'nullable'],
            'rating' => ['sometimes', 'numeric', 'gte:0', 'lte:10', 'nullable'],
            'image' => ['sometimes', 'mimes:heic,jpg,jpeg,png,bmp,gif,svg,webp', 'max:5000', 'nullable'],
            'category_id' => ['sometimes', 'numeric', 'gte:0', 'nullable']
        ],
            [ 'name.unique' => 'That bevvie has already been rated!', ]
        );

        $validated['hasLactose'] = request()->has('hasLactose');
        if (request()->has('image')) {
            $validated['image'] = time() . '.' . 'jpg';
            Image::make(request()->file('image'))
                ->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('/storage/sours/') . $validated['image']);
        }

        $sour->update($validated);

        return redirect(route('sours.index'))->with([
            'success' => 'Your bevvie was successfully updated!'
        ]);
    }

    public function destroy(Sour $sour)
    {
        $sour->delete();

        return redirect(route('sours.index'))->with([
            'success' => 'Your bevvie was successfully deleted!'
        ]);
    }
}
