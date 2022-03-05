<form method="POST" action="{{ route('sours.store') }}" class="p-2" enctype="multipart/form-data">
@csrf
    <h2 class="text-white text-center text-xl uppercase font-bold">Add Sour</h2>
<!-- Name -->
    <div class="mt-4">
        <x-inputs.label for="name" :value="__('Name*')" />

        <x-inputs.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

        <x-inputs.error name="name" />
    </div>

    <!-- Company -->
    <div class="mt-4">
        <x-inputs.label for="company" :value="__('Company*')" />

        <x-inputs.input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required />

        <x-inputs.error name="company" />
    </div>

    <!-- Rating & Percent -->
    <div class="mt-4 flex gap-4">
        <div>
            <x-inputs.label for="rating" :value="__('Rating* (as decimal number)')" />

            <x-inputs.input id="rating" class="block mt-1 w-full" type="text" name="rating" :value="old('rating')" />

            <x-inputs.error name="rating" />
        </div>

        <div>
            <x-inputs.label for="percent" :value="__('Percent (as decimal number)')" />

            <x-inputs.input id="percent" class="block mt-1 w-full" type="text" name="percent" :value="old('percent')" />

            <x-inputs.error name="percent" />
        </div>
    </div>

    <!-- HasLactose -->
    <div class="mt-4">
        <x-inputs.label for="hasLactose" :value="__('Has Lactose?')" class="inline" />

        <x-inputs.input id="hasLactose" value="1" class="w-6 h-6" type="checkbox" name="hasLactose" :value="old('hasLactose')" />

        <x-inputs.error name="hasLactose" />
    </div>

    <!-- Category -->
    <div class="mt-4">
        <x-inputs.label for="category" :value="__('Category')" class="inline" />

        <x-inputs.select :selectedCategory="0" />

        <x-inputs.error name="category" />
    </div>

    <!-- Comments -->
    <div class="mt-4">
        <x-inputs.label for="comments" :value="__('Comments')" />

        <x-inputs.textarea id="comments" class="block mt-1 w-full" rows="4" name="comments" :value="old('comments')" />

        <x-inputs.error name="comments" />
    </div>

    <!-- Image -->
    <div class="mt-4">
        <x-inputs.label for="image" :value="__('Image')" />

        <x-inputs.input id="image" class="block mt-1 w-full rounded-none" type="file" name="image" :value="old('image')" />

        <x-inputs.error name="image" />
    </div>


    <x-inputs.button class="mt-6">
        {{ __('Add Sour') }}
    </x-inputs.button>
</form>
