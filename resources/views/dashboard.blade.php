<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sours') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($sours->count())
                        @foreach($sours as $sour)
                            <div class="md:flex gap-4 mb-8">
                                <img class="md:max-w-xs" src="../images/beer.jpeg">
                                <div>
                                    <div class="flex mb-3">
                                        <h2 class="text-lg"><span class="font-semibold tracking-wide uppercase">Rating:</span> {{ $sour->rating }}</h2>
                                        <h2 class="text-lg pl-10"><span class="font-semibold tracking-wide uppercase">Name:</span> {{ $sour->name }}</h2>
                                    </div>
                                    <div class="flex flex-wrap mb-3">
                                        <h3 class="text-md"><span class="font-semibold tracking-wide uppercase">Percent:</span> {{ $sour->percent }}%</h3>
                                        <h3 class="text-md pl-10"><span class="font-semibold tracking-wide uppercase">Company:</span> {{ $sour->company }}</h3>
                                        <h3 class="text-md pl-10"><span class="font-semibold tracking-wide uppercase">Has Lactose:</span>
                                            @if($sour->hasLactose == 1)
                                                Yes
                                            @else
                                                No
                                            @endif
                                        </h3>
                                    </div>
                                    <p><span class="text-md font-semibold tracking-wide uppercase">Comments:</span> {{ $sour->comments }}</p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <h2>You have not added any sours!</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
