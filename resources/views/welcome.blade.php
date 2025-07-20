<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'InstaApp') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gradient-main selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <a href="/">
                    <x-application-logo class="w-48 h-48 fill-current text-white" />
                </a>
            </div>

            <div class="mt-3 text-center">
                <p class="text-lg text-white/90">
                    Bagikan momen terbaik Anda dengan dunia.
                </p>
            </div>

            <div class="mt-10 flex flex-col sm:flex-row items-center justify-center gap-4">
                @guest
                <a href="{{ route('login') }}" class="inline-block bg-white text-indigo-600 font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
                    Mulai Masuk
                </a>
                <a href="{{ route('register') }}" class="inline-block bg-black/20 text-white font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-black/30 transition duration-300">
                    Buat Akun
                </a>
                @endguest
                @auth
                <a href="{{ url('/dashboard') }}" class="inline-block bg-white text-indigo-600 font-semibold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transition duration-300">
                    Masuk ke Dashboard
                </a>
                @endauth
            </div>

            <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                <div class="text-center text-sm text-white/70 sm:text-left">
                    &copy; {{ date('Y') }} InstaApp
                </div>

                <div class="ml-4 text-center text-sm text-white/70 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) Dibuat dengan ❤️
                </div>
            </div>
        </div>
    </div>
</body>

</html>