<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Progress;

class DegreeProgress extends Progress
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
{
// Get the student's current level from the users table
$level = '4.2';
// Define the levels and their corresponding progress values
$levels = [
'1.1' => 1.25,
'1.2' => 2.5,
'2.1' => 3.75,
'2.2' => 5.0,
'3.1' => 6.25,
'3.2' => 7.5,
'4.1' => 8.75,
'4.2' => 10.0,
];
// Calculate the progress based on the student's current level
$progress = $levels[$level];
return $this->result($progress, 10);
}

    /**
     * Determine the amount of time the results of the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }
    public function name()
    {
        return 'DEGREE COMPLETION LEVEL';
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'degree-progress';
    }
}
