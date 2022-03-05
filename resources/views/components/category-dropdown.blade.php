<x-dropdown>
    <x-slot name="trigger">
        <button class="bg-white px-3 py-2 text-gray-500 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 flex gap-2" >
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Filter by Category' }}

            <x-dropdown-arrow />
        </button>
    </x-slot>
    <x-dropdown-item href="/sours" :active="request()->routeIs('home')">All</x-dropdown-item>

    @foreach ($categories as $category)
        <x-dropdown-item
            href="/sours?category={{ $category->name }}&{{ http_build_query(request()->except('category')) }}"
            :active='request()->is("categories/{{ $category->id }}")'
        >{{ $category->name }}
        </x-dropdown-item>
    @endforeach
</x-dropdown>
