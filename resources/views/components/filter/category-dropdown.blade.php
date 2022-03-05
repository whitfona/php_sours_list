<x-filter.category-dropdown-container>
    <x-slot name="trigger">
        <button class="bg-white px-3 py-2 text-gray-500 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-2 flex gap-2" >
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Filter by Category' }}

            <x-filter.category-dropdown-arrow />
        </button>
    </x-slot>
    <x-filter.category-dropdown-item href="/sours{{ $categoryUrl }}" :active="request()->routeIs('home')">All</x-filter.category-dropdown-item>

    @foreach ($categories as $category)
        <x-filter.category-dropdown-item
            href="/sours{{ $categoryUrl }}?category={{ $category->name }}&{{ http_build_query(request()->except('category')) }}"
            :active='request()->is("categories/{{ $category->id }}")'
        >{{ $category->name }}
        </x-filter.category-dropdown-item>
    @endforeach
</x-filter.category-dropdown-container>
