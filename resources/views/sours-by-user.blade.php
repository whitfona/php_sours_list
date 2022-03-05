<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Sours Added by') }} {{ $user->name }}
        </h2>

        <!-- Search Bar -->
        <form action="{{ route('sours.all') }}" method="GET">
            <x-inputs.input class="mt-2 w-full md:w-1/3" name="search" type="text" value="{{ request('search') }}" placeholder="Search..." />
        </form>

        <!-- Category Filter -->
        <x-category-dropdown />

    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @forelse($sours as $sour)
                        <div class="md:flex gap-4 mb-8">
                            <img class="md:max-w-xs"
                                 @if($sour->image)
                                    src="{{ asset('storage/sours/' . $sour->image) }}"
                                 @else
                                     src="{{ asset('storage/sours/zzzzempty-sour-glass.png') }}"
                                 @endif
                            >
                            <div class="w-full">
                                <div class="md:flex flex-wrap justify-between gap-x-2 gap-y-0 mb-3">
                                    <x-h2-output subheading="Name" value="{!! $sour->name !!}" />
                                    <x-h2-output subheading="Rating" value="{{ $sour->rating }}" />
                                    <x-h2-output subheading="Category" value="{{ $sour->category->name ?? '' }}" />
                                </div>
                                <div class="md:flex flex-wrap justify-between gap-x-2 gap-y-0 mb-3">
                                    <x-h3-output subheading="Percent" value="{{ $sour->percent }}%" />
                                    <x-h3-output subheading="Company" value="{!! $sour->company !!}" />
                                    <h3 class="text-md"><span class="font-semibold tracking-wide uppercase">Has Lactose:</span>
                                        @if($sour->hasLactose == 1)
                                            Yes
                                        @else
                                            No
                                        @endif
                                    </h3>
                                </div>
                                <p class="mb-3"><span class="text-md font-semibold tracking-wide uppercase">Comments:</span> {{ $sour->comments }}</p>
                                <p><span class="text-md font-semibold tracking-wide uppercase">Added By:</span>
                                     @if($sour->user->profileImage)
                                    <img class="w-8 h-8 rounded-full inline" src="{{ asset('storage/users/' . $sour->user->profileImage) }}">
                                    @endif
                                    <a href="/user/{{ $sour->user->name }}">{{ $sour->user->name }}</a> | <time>{{ $sour->created_at->toDateString() }}</time>
                                </p>
                            </div>
                        </div>
                    @empty
                        <h2>No sours to display!</h2>
                    @endforelse
{{--                    {{ $sours->links() }}--}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
