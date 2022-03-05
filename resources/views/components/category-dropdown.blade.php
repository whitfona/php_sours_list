<x-dropdown>
    <x-slot name="trigger">
        <button class="rounded-md bg-white text-left text-gray-500 px-3 py-2 shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 w-full md:w-1/3" >
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Filter by Category' }}

{{--            <x-icon name="down-arrow" />--}}
        </button>
    </x-slot>
    <x-dropdown-item href="/sours" :active="request()->routeIs('home')">All</x-dropdown-item>

    @foreach ($categories as $category)
        <x-dropdown-item
            href="/sours?category={{ $category->name }}"
            :active='request()->is("categories/{{ $category->id }}")'
        >{{ $category->name }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
