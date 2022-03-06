<x-guest-layout>
    @if (Route::has('login'))
        <div class="max-w-lg mx-auto text-right px-6 py-4 sm:block">
            @guest()
                <a href="{{ url('/') }}" class="text-md text-white no-underline hover:underline dark:text-gray-500 ">Home</a>
                <a href="{{ route('login') }}" class="ml-4 text-md text-white no-underline hover:underline dark:text-gray-500 ">Log in</a>
            @endguest
        </div>
    @endif
    <x-auth-card>
        <x-slot name="logo">
            <x-logo />
        </x-slot>

        <div class="px-6 py-4 bg-white rounded-lg">
            <div class="text-center pb-4 ">
                <h2 class="font-medium text-3xl text-gray-700">Register</h2>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-inputs.label for="name" :value="__('Name')" />

                    <x-inputs.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-inputs.label for="email" :value="__('Email')" />

                    <x-inputs.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-inputs.label for="password" :value="__('Password')" />

                    <x-inputs.input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-inputs.label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-inputs.input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-inputs.button class="ml-4">
                        {{ __('Register') }}
                    </x-inputs.button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
