<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>


    <form method="POST" action="{{ route('users.update', auth()->id()) }}" enctype="multipart/form-data"
        class="max-w-xl mx-auto px-6 lg:px-8 pt-16 pb-32">
    @csrf
        @method('PATCH')

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <!-- Name -->
        <div>
            <x-inputs.label for="name" :value="__('Name')" />

            <x-inputs.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $user->name)" required autofocus />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-inputs.label for="email" :value="__('Email')" />

            <x-inputs.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required />
        </div>

        <!-- Profile Image -->
        <div class="mt-4">
            <x-inputs.label for="profileImage" :value="__('Profile Image')" />

            <img class="md:w-80"
                 @if($user->profileImage)
                 src="{{ asset('storage/users/' . $user->profileImage) }}"
                 @else
                 src=""
                @endif
            >

            <x-inputs.input id="profileImage" class="block mt-1 w-full rounded-none" type="file" name="profileImage"/>
        </div>


        <div class="flex items-center justify-end mt-4">
            <x-inputs.button class="ml-4">
                {{ __('Update Profile') }}
            </x-inputs.button>
        </div>
    </form>
</x-app-layout>
