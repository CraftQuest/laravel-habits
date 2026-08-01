@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <div class="mx-auto max-w-md rounded-xl border border-stone-200 bg-white p-8 shadow-sm">
        <h1 class="mb-6 text-xl font-semibold">Welcome back</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-rose-50 p-3 text-sm text-rose-700">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="mb-1 block text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                       class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:border-stone-500 focus:outline-none">
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium">Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:border-stone-500 focus:outline-none">
            </div>

            <label class="flex items-center gap-2 text-sm text-stone-600">
                <input type="checkbox" name="remember" value="1" class="rounded border-stone-300">
                Remember me
            </label>

            <button type="submit" class="w-full rounded-lg bg-stone-900 px-4 py-2 font-medium text-white hover:bg-stone-700">
                Log in
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-stone-500">
            No account yet?
            <a href="{{ route('register') }}" class="font-medium text-stone-900 hover:underline">Register</a>
        </p>
    </div>
@endsection
