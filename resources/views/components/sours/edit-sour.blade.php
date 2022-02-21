<form method="POST" action="{{ route('sours.update', $sour->id) }}" class="p-2">
    @csrf
    @method('PATCH')
    <h2 class="text-white text-center text-xl uppercase font-bold">Edit Sour</h2>
<!-- Name -->
    <div class="mt-4">
        <x-label for="name" :value="__('Name')" />

        <x-inputs.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $sour->name)" required autofocus />

        <x-inputs.error name="name" />
    </div>

    <!-- Company -->
    <div class="mt-4">
        <x-label for="company" :value="__('Company')" />

        <x-inputs.input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company', $sour->company)" required />

        <x-inputs.error name="company" />
    </div>

    <!-- Rating & Percent -->
    <div class="mt-4 flex gap-4">
        <div>
            <x-label for="rating" :value="__('Rating')" />

            <x-inputs.input id="rating" class="block mt-1 w-full" type="text" name="rating" :value="old('rating', $sour->rating)" />

            <x-inputs.error name="rating" />
        </div>

        <div>
            <x-label for="percent" :value="__('Percent')" />

            <x-inputs.input id="percent" class="block mt-1 w-full" type="text" name="percent" :value="old('percent', $sour->percent)" />

            <x-inputs.error name="percent" />
        </div>
    </div>

    <!-- HasLactose -->
    <div class="mt-4">
        <x-label for="hasLactose" :value="__('Has Lactose?')" class="inline" />

        @if($sour->hasLactose == true)
        <x-inputs.input id="hasLactose" value="1" class="w-6 h-6" type="checkbox" name="hasLactose" :value="old('hasLactose')" checked />
        @else
        <x-inputs.input id="hasLactose" value="1" class="w-6 h-6" type="checkbox" name="hasLactose" :value="old('hasLactose')" />
        @endif

        <x-inputs.error name="hasLactose" />
    </div>

    <!-- Comments -->
    <div class="mt-4">
        <x-label for="comments" :value="__('Comments')" />

        <x-textarea id="comments" class="block mt-1 w-full" rows="4" name="comments" :value="old('comments', $sour->comments)" />

        <x-inputs.error name="comments" />
    </div>


    <x-button class="mt-6">
        {{ __('Edit Sour') }}
    </x-button>
</form>
