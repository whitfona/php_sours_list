<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sours') }}
        </h2>
    </x-slot>

    <div x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen=false">
        <div class="overlay" x-show="isModalOpen" x-cloak z-1></div>

        <button x-on:click="isModalOpen = true" class="max-w-fit mx-auto sm:px-6 rounded-md mt-6 p-4 bg-pink-400 flex justify-center items-center hover:cursor-pointer hover:bg-pink-300">
            <x-plus-icon />
            <p class="text-4xl text-white font-extrabold uppercase pl-3">Add Sour</p>
        </button>

        <!-- Add Sour Form -->
        <div
            class="modal max-w-7xl mx-auto sm:px-6 lg:px-8 py-6 z-10 bg-pink-300 rounded fixed top-[10%] left-[50%] w-[90%] -translate-x-2/4"
            role="dialog"
            tabindex="-1"
            x-show="isModalOpen"
            x-on:click.away="isModalOpen = false"
            x-cloak
        >
            <x-sours.add-sour />
        </div>
    </div>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($sours->count())
                        @foreach($sours as $sour)
                            <div class="mb-8">
                                <div class="md:flex gap-4">
                                    <img class="md:max-w-xs" src="../images/beer.jpeg">
                                    <div class="sm:mt-4 w-full">
                                        <div class="flex flex-wrap gap-x-2 gap-y-0 mb-3">
                                            <h2 class="text-lg w-32"><span class="font-semibold tracking-wide uppercase">Rating:</span> {{ $sour->rating }}</h2>
                                            <h2 class="text-lg"><span class="font-semibold tracking-wide uppercase">Name:</span> {{ $sour->name }}</h2>
                                        </div>
                                        <div class="flex flex-wrap justify-between gap-x-2 gap-y-0 mb-3">
                                            <h3 class="text-md"><span class="font-semibold tracking-wide uppercase">Percent:</span> {{ $sour->percent }}%</h3>
                                            <h3 class="text-md"><span class="font-semibold tracking-wide uppercase">Company:</span> {{ $sour->company }}</h3>
                                            <h3 class="text-md"><span class="font-semibold tracking-wide uppercase">Has Lactose:</span>
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
                                <div x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen=false">
                                    <div class="overlay" x-show="isModalOpen" x-cloak z-1></div>
                                    <!-- Delete Sour -->
                                    <form method="POST" onclick="return confirm('Are you sure you want to delete this sour?')" action="/sours/{{ $sour->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="max-w-fit sm:px-6 rounded-md mt-6 p-4 bg-pink-400 flex justify-center items-center hover:cursor-pointer hover:bg-pink-300">
                                            <p class="text-md text-white font-extrabold uppercase pl-3">Delete Sour</p>
                                        </button>
                                    </form>
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
