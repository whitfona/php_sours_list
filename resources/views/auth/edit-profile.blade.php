<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <x-logo />
        </x-slot>

        <div class="text-center pb-4 ">
            <h2 class="font-medium text-3xl text-gray-700">Edit Profile</h2>
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> // TODO: Update action route
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

            <!-- Profile Image -->
            <div class="mt-4">
                <x-inputs.label for="profileImage" :value="__('Profile Image')" />

                <x-inputs.input id="profileImage" class="block mt-1 w-full"
                                type="file"
                                name="profileImage"
                />
            </div>


            <div class="flex items-center justify-end mt-4">
                <x-inputs.button class="ml-4">
                    {{ __('Update Profile') }}
                </x-inputs.button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
