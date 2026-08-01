<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'color'])]
class Habit extends Model
{
    public const COLORS = ['emerald', 'sky', 'amber', 'rose', 'violet'];

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<HabitCompletion, $this>
     */
    public function completions(): HasMany
    {
        return $this->hasMany(HabitCompletion::class);
    }

    public function isCompletedOn(CarbonInterface $date): bool
    {
        return $this->completions->contains(
            fn (HabitCompletion $completion) => $completion->completed_on->isSameDay($date)
        );
    }

    /**
     * Consecutive completed days ending today (or yesterday, if today
     * hasn't been checked off yet).
     */
    public function currentStreak(): int
    {
        $completedDates = $this->completions
            ->map(fn (HabitCompletion $completion) => $completion->completed_on->toDateString());

        $day = today();

        if (! $completedDates->contains($day->toDateString())) {
            $day->subDay();
        }

        $streak = 0;

        while ($completedDates->contains($day->toDateString())) {
            $streak++;
            $day->subDay();
        }

        return $streak;
    }
}
