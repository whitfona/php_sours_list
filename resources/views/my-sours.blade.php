@php
    $categoryUrl = "/my-sours";
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('My Bevvies') }}
        </h2>

        <!-- Search Bar -->
        <form action="{{ route('sours.index') }}" method="GET">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <x-inputs.input class="mt-2 w-full md:w-1/3" name="search" type="text" value="{{ request('search') }}" placeholder="Search..." />
        </form>

        <!-- Category Filter -->
        <x-filter.category-dropdown :categoryUrl="$categoryUrl" />

    </x-slot>

    <a class="max-w-fit mx-auto sm:px-6 rounded-md mt-6 p-4 bg-pink-400 flex justify-center items-center hover:cursor-pointer hover:bg-pink-300" href="{{ route('sours.create') }}">
        <x-plus-icon />
        <p class="text-4xl text-white font-extrabold uppercase pl-3">Add</p>
    </a>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-pink-200 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="m-6 p-6 bg-white">
                    @forelse($sours as $sour)
                        <div class="mb-8">
                            <div class="md:flex gap-4">
                                <img class="md:max-w-xxs"
                                     @if($sour->image)
                                        src="{{ asset('storage/sours/' . $sour->image) }}"
                                     @else
                                        src="{{ asset('storage/sours/zzzzempty-sour-glass.png') }}"
                                     @endif
                                >
                                <div class="pt-6 md:pt-0 w-full">
                                    <div class="md:flex flex-wrap justify-between gap-x-2 gap-y-0 mb-3">
                                        <x-h2-output subheading="Name" value="{!! $sour->name !!}" />
                                        <x-h2-output subheading="Rating" value="{{ $sour->rating }}" />
                                        <x-h2-output subheading="Category" value="{{ $sour->category->name ?? '' }}" />
                                    </div>
                                    <div class="md:flex flex-wrap justify-between gap-x-2 gap-y-0 mb-3">
                                        <x-h3-output subheading="Percent" value="{{ $sour->percent }}%" />
                                        <x-h3-output subheading="Brewery" value="{!! $sour->company !!}" />
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
                            <!-- Delete Button -->
                            <form method="POST" onclick="return confirm('Are you sure you want to delete this sour?')" action="/sours/{{ $sour->id }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="max-w-fit sm:px-6 rounded-md mt-6 p-4 bg-pink-400 hover:cursor-pointer hover:bg-pink-300 inline">
                                    <p class="text-md text-white font-extrabold uppercase">Delete</p>
                                </button>
                            </form>

                            <!-- Edit Button -->
                            <a class="max-w-fit sm:px-6 rounded-md mt-6 p-4 bg-pink-400 hover:cursor-pointer hover:bg-pink-300 inline-block" href="{{ route('sours.show', $sour) }}">
                                <span class="text-md text-white font-extrabold uppercase">Edit</span>
                            </a>
                        </div>
                    @empty
                        <h2>You have not added any sours!</h2>
                    @endforelse
                    {{ $sours->links() }}
            </div>
            </div>
        </div>
    </div>
</x-app-layout>
