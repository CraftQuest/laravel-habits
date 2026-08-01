<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Habits') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-stone-100 text-stone-900 antialiased">
    <nav class="border-b border-stone-200 bg-white">
        <div class="mx-auto flex max-w-3xl items-center justify-between px-4 py-3">
            <a href="{{ url('/') }}" class="text-lg font-semibold tracking-tight">🌱 Habits</a>

            @auth
                <div class="flex items-center gap-4">
                    <span class="text-sm text-stone-600">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-stone-500 hover:text-stone-900">
                            Log out
                        </button>
                    </form>
                </div>
            @else
                <div class="flex items-center gap-4 text-sm font-medium">
                    <a href="{{ route('login') }}" class="text-stone-500 hover:text-stone-900">Log in</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-stone-900 px-3 py-1.5 text-white hover:bg-stone-700">Register</a>
                </div>
            @endauth
        </div>
    </nav>

    <main class="mx-auto max-w-3xl px-4 py-8">
        @yield('content')
    </main>
</body>
</html>
