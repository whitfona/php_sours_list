<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full bg-pink-400 sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
    <div class="flex justify-center mt-10 sm:items-center sm:justify-center">
        <div class="text-center text-sm text-white sm:text-left">
            <div class="flex items-center text-white">
                <a href="https://whitforddesign.ca" class="text-white no-underline hover:underline">
                    Whitford Design | 2022
                </a>
            </div>
        </div>
    </div>
</div>
