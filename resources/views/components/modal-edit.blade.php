<div x-data="{'isModalOpen': false}" x-on:keydown.escape="isModalOpen=false">
    <div class="overlay" x-show="isModalOpen" x-cloak z-1></div>
    <!-- Delete Sour -->
    <form method="POST" onclick="return confirm('Are you sure you want to delete this sour?')" action="/sours/{{ $sour->id }}" class="inline">
        @csrf
        @method('DELETE')
        <button class="max-w-fit sm:px-6 rounded-md mt-6 p-4 bg-pink-400 hover:cursor-pointer hover:bg-pink-300 inline">
            <p class="text-md text-white font-extrabold uppercase">Delete Sour</p>
        </button>
    </form>

    <!-- Edit Form Button -->
    <button x-on:click="isModalOpen = true" x-on:click.document="window.scrollTo(0, 0)" class="max-w-fit sm:px-6 rounded-md mt-6 p-4 bg-pink-400 hover:cursor-pointer hover:bg-pink-300 ml-4">
        <p class="text-md text-white font-extrabold uppercase">{{ $buttonText }}</p>
    </button>

    <!-- Edit Sour Form -->
    <div
        class="modal max-w-7xl mx-auto sm:px-6 lg:px-8 py-6 z-10 bg-pink-300 rounded absolute top-[10%] left-[50%] w-[90%] -translate-x-2/4"
        role="dialog"
        tabindex="1"
        x-show="isModalOpen"
        x-on:click.away="isModalOpen = false"
        x-cloak
    >
        {{ $slot }}
    </div>
</div>
