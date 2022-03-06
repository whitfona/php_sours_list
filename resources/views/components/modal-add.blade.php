@if(count($errors) > 0)
<div x-data="{'isModalOpen': true}" x-on:keydown.escape="isModalOpen=false">
    <div class="overlay" x-show="isModalOpen" x-cloak z-1></div>

    <button x-on:click="isModalOpen = true" class="max-w-fit mx-auto sm:px-6 rounded-md mt-6 p-4 bg-pink-400 flex justify-center items-center hover:cursor-pointer hover:bg-pink-300">
        <x-plus-icon />
        <p class="text-4xl text-white font-extrabold uppercase pl-3">{{ $buttonText }}</p>
    </button>

    <!-- Add Sour Form -->
    <div
        class="modal max-w-7xl sm:px-6 lg:px-8 py-6 z-10 bg-pink-300 rounded absolute top-[10%] left-[50%] w-[90%] -translate-x-2/4"
        role="dialog"
        x-show="isModalOpen"
        x-on:click.away="isModalOpen = false"
        style="display: none"
    >
        {{ $slot }}
    </div>
</div>
@else
<div x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen=false">
    <div class="overlay" x-show="isModalOpen" x-cloak z-1></div>

    <button x-on:click="isModalOpen = true" class="max-w-fit mx-auto sm:px-6 rounded-md mt-6 p-4 bg-pink-400 flex justify-center items-center hover:cursor-pointer hover:bg-pink-300">
        <x-plus-icon />
        <p class="text-4xl text-white font-extrabold uppercase pl-3">{{ $buttonText }}</p>
    </button>

    <!-- Add Sour Form -->
    <div
        class="modal max-w-7xl sm:px-6 lg:px-8 py-6 z-10 bg-pink-300 rounded absolute top-[10%] left-[50%] w-[90%] -translate-x-2/4"
        role="dialog"
        x-show="isModalOpen"
        x-on:click.away="isModalOpen = false"
        style="display: none"
    >
        {{ $slot }}
    </div>
</div>
@endif
