<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use App\Models\User;
class UsersPerPlan extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, User::class, 'role')
            ->label(function ($value) {
                switch ($value) {
                    case 'admin':
                        return 'Admins';
                    case 'student':
                        return 'Students';
                    case 'lecturer':
                        return 'Lecturers';
                    case 'user':
                        return 'Students';
                    default:
                        return ucfirst($value);
                }
            });
    }

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return \DateTimeInterface|\DateInterval|float|int|null
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'users-per-plan';
    }

    public function name()
    {
        return 'University Users';
    }
}
