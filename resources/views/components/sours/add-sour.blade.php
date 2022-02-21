<form method="POST" action="{{ route('sours.store') }}" class="p-2">
@csrf
    <h2 class="text-white text-center text-xl uppercase font-bold">Add Sour</h2>
<!-- Name -->
    <div class="mt-4">
        <x-label for="name" :value="__('Name')" />

        <x-inputs.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

        <x-error name="name" />
    </div>

    <!-- Company -->
    <div class="mt-4">
        <x-label for="company" :value="__('Company')" />

        <x-inputs.input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company')" required />

        <x-error name="company" />
    </div>

    <!-- Rating & Percent -->
    <div class="mt-4 flex gap-4">
        <div>
            <x-label for="rating" :value="__('Rating')" />

            <x-inputs.input id="rating" class="block mt-1 w-full" type="text" name="rating" :value="old('rating')" />

            <x-error name="rating" />
        </div>

        <div>
            <x-label for="percent" :value="__('Percent')" />

            <x-inputs.input id="percent" class="block mt-1 w-full" type="text" name="percent" :value="old('percent')" />

            <x-error name="percent" />
        </div>
    </div>

    <!-- HasLactose -->
    <div class="mt-4">
        <x-label for="hasLactose" :value="__('Has Lactose?')" class="inline" />

        <x-inputs.input id="hasLactose" value="1" class="w-6 h-6" type="checkbox" name="hasLactose" :value="old('hasLactose')" />

        <x-error name="hasLactose" />
    </div>

    <!-- Comments -->
    <div class="mt-4">
        <x-label for="comments" :value="__('Comments')" />

        <x-textarea id="comments" class="block mt-1 w-full" rows="4" name="comments" :value="old('comments')" />

        <x-error name="comments" />
    </div>


    <x-button class="mt-6">
        {{ __('Add Sour') }}
    </x-button>
</form>
