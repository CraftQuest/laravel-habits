@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="mx-auto max-w-md rounded-xl border border-stone-200 bg-white p-8 shadow-sm">
        <h1 class="mb-6 text-xl font-semibold">Create your account</h1>

        @if ($errors->any())
            <div class="mb-4 rounded-lg bg-rose-50 p-3 text-sm text-rose-700">
                <ul class="list-inside list-disc space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                       class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:border-stone-500 focus:outline-none">
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:border-stone-500 focus:outline-none">
            </div>

            <div>
                <label for="password" class="mb-1 block text-sm font-medium">Password</label>
                <input id="password" name="password" type="password" required
                       class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:border-stone-500 focus:outline-none">
            </div>

            <div>
                <label for="password_confirmation" class="mb-1 block text-sm font-medium">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                       class="w-full rounded-lg border border-stone-300 px-3 py-2 focus:border-stone-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full rounded-lg bg-stone-900 px-4 py-2 font-medium text-white hover:bg-stone-700">
                Register
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-stone-500">
            Already have an account?
            <a href="{{ route('login') }}" class="font-medium text-stone-900 hover:underline">Log in</a>
        </p>
    </div>
@endsection
