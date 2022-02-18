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
                    @foreach($sours as $sour)
                        <div>
                            <p>Rating: {{ $sour->rating }}</p>
                            <p>Company: {{ $sour->company }} | Name: {{ $sour->name }}</p>
                            <p>Percent: {{ $sour->percent }} | Has Lactose: {{ $sour->hasLactose }}</p>
                            <p>Comments: {{ $sour->comments }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
