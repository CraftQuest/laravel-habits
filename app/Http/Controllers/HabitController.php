<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class HabitController extends Controller
{
    public function index(Request $request): View
    {
        $days = collect(range(6, 0))
            ->map(fn (int $daysAgo) => today()->subDays($daysAgo)->toImmutable());

        $habits = $request->user()->habits()
            ->with(['completions' => fn ($query) => $query->orderByDesc('completed_on')])
            ->orderBy('created_at')
            ->get();

        return view('habits.index', [
            'days' => $days,
            'habits' => $habits,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'color' => ['required', Rule::in(Habit::COLORS)],
        ]);

        $request->user()->habits()->create($validated);

        return redirect()->route('habits.index');
    }

    public function update(Request $request, Habit $habit): RedirectResponse
    {
        Gate::authorize('update', $habit);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'color' => ['required', Rule::in(Habit::COLORS)],
        ]);

        $habit->update($validated);

        return redirect()->route('habits.index');
    }

    public function destroy(Request $request, Habit $habit): RedirectResponse
    {
        Gate::authorize('delete', $habit);

        $habit->delete();

        return redirect()->route('habits.index');
    }

    public function toggle(Request $request, Habit $habit): RedirectResponse
    {
        Gate::authorize('update', $habit);

        $validated = $request->validate([
            'date' => ['required', 'date_format:Y-m-d', 'before_or_equal:today', 'after_or_equal:'.today()->subDays(6)->toDateString()],
        ]);

        $date = Carbon::parse($validated['date']);

        $completion = $habit->completions()->whereDate('completed_on', $date)->first();

        if ($completion) {
            $completion->delete();
        } else {
            $habit->completions()->create(['completed_on' => $date]);
        }

        return redirect()->route('habits.index');
    }
}
