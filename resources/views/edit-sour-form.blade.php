<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit Bevvie') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="m-6 p-6 bg-white">
                    <form method="POST" action="{{ route('sours.update', $sour) }}" class="p-2" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <h2 class="text-pink-500 text-center text-2xl uppercase font-bold">Edit Bevvie - {{ $sour->name }}</h2>

                        <div class="md:flex md:gap-4">
                            <!-- Name -->
                            <div class="mt-4 md:grow">
                                <x-inputs.label for="name" :value="__('Name*')" />

                                <x-inputs.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $sour->name" required autofocus />

                                <x-inputs.error name="name" />
                            </div>

                            <!-- Company -->
                            <div class="mt-4 md:grow">
                                <x-inputs.label for="company" :value="__('Brewery*')" />

                                <x-inputs.input id="company" class="block mt-1 w-full" type="text" name="company" :value="old('company') ?? $sour->company" required />

                                <x-inputs.error name="company" />
                            </div>
                        </div>

                        <div class="md:flex">
                            <!-- Rating & Percent -->
                            <div class="mt-4 flex gap-4">
                                <div>
                                    <x-inputs.label for="rating" :value="__('Rating* (as decimal number)')" />

                                    <x-inputs.input id="rating" class="block mt-1 w-full" type="text" name="rating" :value="old('rating') ?? $sour->rating" />

                                    <x-inputs.error name="rating" />
                                </div>

                                <div>
                                    <x-inputs.label for="percent" :value="__('Percent (as decimal number)')" />

                                    <x-inputs.input id="percent" class="block mt-1 w-full" type="text" name="percent" :value="old('percent') ?? $sour->percent" />

                                    <x-inputs.error name="percent" />
                                </div>
                            </div>

                            <div class="mt-4 flex gap-4 md:mt-0 md:ml-4">
                                <!-- Category & HasLactose -->
                                <div class="mt-4">
                                    <x-inputs.label for="category" :value="__('Category')" class="mb-1" />

                                    <x-inputs.select :selectedCategory="$sour->category->id ?? ''" />

                                    <x-inputs.error name="category" />
                                </div>

                                <div class="mt-4">
                                    <x-inputs.label for="hasLactose" :value="__('Has Lactose?')" class="mb-1" />

                                    @if($sour->hasLactose == true)
                                        <x-inputs.input id="hasLactose" value="1" class="w-6 h-6" type="checkbox" name="hasLactose" :value="old('hasLactose')" checked />
                                    @else
                                        <x-inputs.input id="hasLactose" value="1" class="w-6 h-6 md:w-10 md:h-10" type="checkbox" name="hasLactose" :value="old('hasLactose')" />
                                    @endif

                                    <x-inputs.error name="hasLactose" />
                                </div>
                            </div>
                        </div>
                        <!-- Comments -->
                        <div class="mt-4">
                            <x-inputs.label for="comments" :value="__('Comments')" />

                            <x-inputs.textarea id="comments" class="block mt-1 w-full" rows="4" name="comments" :value="old('comments') ?? $sour->comments" />

                            <x-inputs.error name="comments" />
                        </div>

                        <!-- Image -->
                        <div class="mt-4">
                            <x-inputs.label for="image" :value="__('Image')" />

                            <x-inputs.input id="image" class="block mt-1 w-full rounded-none" type="file" name="image" :value="$sour->image" />

                            <x-inputs.error name="image" />
                        </div>


                        <x-inputs.button class="mt-8 mr-10">
                            {{ __('Save') }}
                        </x-inputs.button>

                        <a class="inline-flex items-center px-10 py-6 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" href="{{ route('sours.index') }}">
                            <span class="text-md text-white font-extrabold uppercase">Exit</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
