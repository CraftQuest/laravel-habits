@extends('layouts.app')

@section('title', 'My habits')

@section('content')
    @php
        $colorDot = [
            'emerald' => 'bg-emerald-500',
            'sky' => 'bg-sky-500',
            'amber' => 'bg-amber-500',
            'rose' => 'bg-rose-500',
            'violet' => 'bg-violet-500',
        ];
        $colorDone = [
            'emerald' => 'bg-emerald-500 border-emerald-500 text-white',
            'sky' => 'bg-sky-500 border-sky-500 text-white',
            'amber' => 'bg-amber-500 border-amber-500 text-white',
            'rose' => 'bg-rose-500 border-rose-500 text-white',
            'violet' => 'bg-violet-500 border-violet-500 text-white',
        ];
    @endphp

    <h1 class="mb-6 text-2xl font-semibold tracking-tight">My habits</h1>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-rose-50 p-3 text-sm text-rose-700">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- New habit form --}}
    <form method="POST" action="{{ route('habits.store') }}"
          class="mb-8 flex flex-wrap items-center gap-3 rounded-xl border border-stone-200 bg-white p-4 shadow-sm">
        @csrf
        <input name="name" type="text" placeholder="Add a habit, e.g. “Read 20 minutes”" required maxlength="100"
               value="{{ old('name') }}"
               class="min-w-0 flex-1 rounded-lg border border-stone-300 px-3 py-2 focus:border-stone-500 focus:outline-none">
        <select name="color" class="rounded-lg border border-stone-300 px-2 py-2 text-sm">
            @foreach (\App\Models\Habit::COLORS as $color)
                <option value="{{ $color }}" @selected(old('color') === $color)>{{ ucfirst($color) }}</option>
            @endforeach
        </select>
        <button type="submit" class="rounded-lg bg-stone-900 px-4 py-2 font-medium text-white hover:bg-stone-700">
            Add
        </button>
    </form>

    @if ($habits->isEmpty())
        <div class="rounded-xl border border-dashed border-stone-300 p-10 text-center text-stone-500">
            No habits yet. Add your first one above — small steps, every day. 🌱
        </div>
    @endif

    <div class="space-y-4">
        @foreach ($habits as $habit)
            <div class="rounded-xl border border-stone-200 bg-white p-4 shadow-sm">
                <div class="mb-3 flex items-center justify-between gap-3">
                    <div class="flex min-w-0 items-center gap-2">
                        <span class="h-2.5 w-2.5 shrink-0 rounded-full {{ $colorDot[$habit->color] ?? 'bg-stone-400' }}"></span>
                        <span class="truncate font-medium">{{ $habit->name }}</span>
                        @if (($streak = $habit->currentStreak()) > 0)
                            <span class="shrink-0 rounded-full bg-stone-100 px-2 py-0.5 text-xs font-medium text-stone-600">
                                🔥 {{ $streak }}-day streak
                            </span>
                        @endif
                    </div>

                    <details class="relative shrink-0">
                        <summary class="cursor-pointer list-none rounded-lg px-2 py-1 text-sm text-stone-400 hover:bg-stone-100 hover:text-stone-700">Edit</summary>
                        <div class="absolute right-0 z-10 mt-1 w-64 rounded-xl border border-stone-200 bg-white p-3 shadow-lg">
                            <form method="POST" action="{{ route('habits.update', $habit) }}" class="space-y-2">
                                @csrf
                                @method('PATCH')
                                <input name="name" type="text" value="{{ $habit->name }}" required maxlength="100"
                                       class="w-full rounded-lg border border-stone-300 px-2 py-1.5 text-sm">
                                <select name="color" class="w-full rounded-lg border border-stone-300 px-2 py-1.5 text-sm">
                                    @foreach (\App\Models\Habit::COLORS as $color)
                                        <option value="{{ $color }}" @selected($habit->color === $color)>{{ ucfirst($color) }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="w-full rounded-lg bg-stone-900 px-3 py-1.5 text-sm font-medium text-white hover:bg-stone-700">Save</button>
                            </form>
                            <form method="POST" action="{{ route('habits.destroy', $habit) }}" class="mt-2"
                                  onsubmit="return confirm('Delete “{{ $habit->name }}” and its history?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full rounded-lg px-3 py-1.5 text-sm font-medium text-rose-600 hover:bg-rose-50">Delete</button>
                            </form>
                        </div>
                    </details>
                </div>

                <div class="grid grid-cols-7 gap-2">
                    @foreach ($days as $day)
                        @php $done = $habit->isCompletedOn($day); @endphp
                        <form method="POST" action="{{ route('habits.toggle', $habit) }}">
                            @csrf
                            <input type="hidden" name="date" value="{{ $day->toDateString() }}">
                            <button type="submit"
                                    title="{{ $day->format('D, M j') }}{{ $done ? ' — completed' : '' }}"
                                    class="flex w-full flex-col items-center gap-1 rounded-lg border px-1 py-2 text-xs transition
                                        {{ $done ? ($colorDone[$habit->color] ?? 'bg-stone-500 border-stone-500 text-white') : 'border-stone-200 text-stone-500 hover:border-stone-400' }}">
                                <span class="font-medium {{ $day->isToday() ? 'underline underline-offset-2' : '' }}">{{ $day->format('D') }}</span>
                                <span>{{ $done ? '✓' : $day->format('j') }}</span>
                            </button>
                        </form>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
