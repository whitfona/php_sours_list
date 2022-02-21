<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('All Sours') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @forelse($sours as $sour)
                        <div class="md:flex gap-4 mb-8">
                            <img class="md:max-w-xs" src="../images/beer.jpeg">
                            <div class="sm:mt-4 w-full">
                                <div class="md:flex flex-wrap gap-x-2 gap-y-0 mb-3">
                                    <x-h2-output subheading="Rating" value="{{ $sour->rating }}" />
                                    <x-h2-output subheading="Name" value="{{ $sour->name }}" />
                                </div>
                                <div class="md:flex flex-wrap justify-between gap-x-2 gap-y-0 mb-3">
                                    <x-h3-output subheading="Percent" value="{{ $sour->percent }}%" />
                                    <x-h3-output subheading="Company" value="{{ $sour->company }}" />
                                    <h3 class="text-md"><span class="font-semibold tracking-wide uppercase">Has Lactose:</span>
                                        @if($sour->hasLactose == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </h3>
                                </div>
                                <p class="mb-3"><span class="text-md font-semibold tracking-wide uppercase">Comments:</span> {{ $sour->comments }}</p>
                                <p><span class="text-md font-semibold tracking-wide uppercase">Added By:</span> {{ $sour->user->name }} | <time>{{ $sour->created_at->toDateString() }}</time>
                                </p>
                            </div>
                        </div>
                    @empty
                        <h2>No sours to display!</h2>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
