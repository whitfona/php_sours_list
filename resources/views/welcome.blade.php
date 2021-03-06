<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SHOUTS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-pink-400">
        <div class="">
            @if (Route::has('login'))
                <div class="max-w-lg mx-auto text-right px-6 py-4 sm:block">
                    <a href="{{ url('/sours') }}" class="text-md text-white no-underline hover:underline dark:text-gray-500 ">All Bevvies</a>
                    <a href="{{ route('login') }}" class="ml-4 text-md text-white no-underline hover:underline dark:text-gray-500 ">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-md text-white no-underline hover:underline dark:text-gray-500 ">Register</a>
                    @endif
                </div>
            @endif

            <div class="screen max-w-lg mx-auto flex flex-col justify-center items-center pt-6 sm:pt-0">
                <x-logo />

                <div class="w-full bg-pink-400 sm:bg-white sm:max-w-md mt-6 px-6 py-4 bg-white overflow-hidden sm:rounded-lg">
                    <div class="px-6 py-4 bg-white rounded-lg">
                        <p>Have you ever been drinking with your pals and thought, <em>"Well how do you do, this certainly is a splendid tasting brew! I sure would like to wet my palate with this again."</em> But then proceeded to sample a few many cold ones that they all became a blur? Having experienced a similar situation, <strong>SHOUTS</strong> is here so that never happens again. Add, rate and share your bevvies, so you can enjoy your favourites and will never again have to suffer through a bevvie a previous you forgot you disliked.</p>
                    </div>
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
        </div>
    </body>
</html>
