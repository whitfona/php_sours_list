<x-guest-layout>
    @if (Route::has('login'))
        <div class="max-w-lg mx-auto text-right px-6 py-4 sm:block">
            @guest()
                <a href="{{ url('/') }}" class="text-md text-white no-underline hover:underline dark:text-gray-500 ">Home</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-md text-white no-underline hover:underline dark:text-gray-500 ">Register</a>
                @endif
            @endguest
        </div>
    @endif
    <x-auth-card>
        <x-slot name="logo">
            <x-logo />
        </x-slot>

        <div class="px-6 py-4 bg-white rounded-lg">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="text-center pb-4">
                <h2 class="font-medium text-3xl text-gray-700">Log In</h2>
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    {{ __('Need to Register?') }}
                </a>
            </div>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-inputs.label for="email" :value="__('Email')" />

                    <x-inputs.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-inputs.label for="password" :value="__('Password')" />

                    <x-inputs.input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-inputs.button class="ml-3">
                        {{ __('Log in') }}
                    </x-inputs.button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
