<x-dropdown>
    <x-slot name="trigger">
        <button class="py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex" >
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}

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
