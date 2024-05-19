<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use App\Models\Results;


class ResultGradeTrend extends Partition
{

    public function name()
{
    return 'ALL COURSES GRADES';
}

public function calculate(NovaRequest $request)
{
// Get the student's grades

$grades = Results::where('email', $request->user()->email)->get();
// Partition the grades into groups (1, 2.1, 2.2, 3, F)
$partitions = [




'F' => $grades->where('grade', 'F')->count(),
'Grade 3' => $grades->where('grade', '3')->count(),
'Grade 2.2' => $grades->where('grade', '2.2')->count(),
'Grade 2.1' => $grades->where('grade', '2.1')->count(),
'Distinctions' => $grades->where('grade', '1')->count(),
];
return $this->result($partitions);
}

    /**
     * Determine for the metric should be displayed for the given request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return bool
     */
// public function authorize($request)
// {
//     // Only show the metric to the user who owns the email
//     return $request->user()->email === 'nmunyengwa2019@gmail.com';
// }
// {
// // Only show the metric to the user who owns the email
// return $request->user()->email === Results::find($request->resourceId)->email;
// }

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
        return 'result-grade-trend';
    }
}
