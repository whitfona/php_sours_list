<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Intervention\Image\Facades\Image;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the edit profile view.
     *
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('edit-profile', compact('user'));
    }

    public function update(User $user)
    {
        $validated = \request()->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'profileImage' => ['sometimes', 'mimes:heic,jpg,jpeg,png,bmp,gif,svg,webp', 'max:5000', 'nullable']
        ]);

        if (request()->has('profileImage')) {
            $validated['profileImage'] = time() . '.' . 'jpg';
            Image::make(request()->file('profileImage'))
                ->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->orientate()
                ->save(public_path('/storage/users/') . $validated['profileImage']);
        }

        if (request()->has('image')) {
            $validated['image'] = time() . '.' . 'jpg';
            Image::make(request()->file('image'))
                ->resize(512, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save(public_path('/storage/sours/') . $validated['image']);
        }

        $user->update($validated);

        return redirect(route('users.edit', $user->id))->with([
            'success' => 'Your profile was successfully updated!'
        ]);
    }
}
