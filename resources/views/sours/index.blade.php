<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sours Tracker</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #ff6cbb;
        }
    </style>
</head>
<body class="antialiased">
<div class="relative flex items-top justify-center min-h-screen dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-start items-center pt-8 sm:pt-0">
{{--        <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">--}}
            <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            <h1>Sours App Name</h1>
        </div>

        <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
            <div class="grid grid-cols-1">
                <div class="py-12">
                    <h1>All the Sours:</h1>

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

        <div class="flex justify-center mt-4 sm:items-center sm:justify-center">
            <div class="text-center text-sm text-white sm:text-left">
                <div class="flex items-center">
                    <a href="https://whitforddesign.ca" class="ml-1 underline">
                        Whitford Design | 2022
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
