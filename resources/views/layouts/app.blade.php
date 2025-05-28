<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body class="bg-gray-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('user') }}" class="text-xl font-bold text-blue-600">Rekomendasi Laptop</a>
            <div>
                @auth
                    <span class="mr-4 text-gray-700">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Logout</button>
                    </form>
                @endauth
                @guest
                    <a href="{{ route('login') }}" class="text-blue-500 px-3">Login</a>
                    <a href="{{ route('register') }}" class="text-blue-500 px-3">Register</a>
                @endguest
            </div>
        </div>
    </nav>
    <div class="container mx-auto flex">

        <main class="flex-1">
            @yield('content')
        </main>
    </div>
</body>

</html>
