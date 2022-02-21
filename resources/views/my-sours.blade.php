<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('My Sours') }}
        </h2>

        <!-- Search Bar -->
        <form action="{{ route('sours.index') }}" method="GET">
            <x-inputs.input class="mt-2 w-full md:w-1/3" name="search" type="text" value="{{ request('search') }}" placeholder="Search..." />
        </form>
    </x-slot>

    <x-modal-add buttonText="Add Sour">
        <x-sours.add-sour />
    </x-modal-add>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                    @forelse($sours as $sour)
                        <div class="mb-8">
                            <div class="md:flex gap-4">
                                <img class="md:max-w-xs" src="../images/beer.jpeg">
                                <div class="pt-6 md:pt-0 w-full">
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
                                    <p><span class="text-md font-semibold tracking-wide uppercase">Comments:</span> {{ $sour->comments }}</p>
                                </div>
                            </div>
                            <x-modal-edit buttonText="Edit Sour" :sour="$sour" >
                                <x-sours.edit-sour :sour="$sour" />
                            </x-modal-edit>
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
