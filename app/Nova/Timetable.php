<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use App\Nova\Actions;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;





class Timetable extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Timetable>
     */
    public static $model = \App\Models\Timetable::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Department';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'Department','Level','course_code','venue','time','day','duration','lecturer',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable()->hide(),  
            //department
            Select::make('Department')
                ->options([
                    $departments = \App\Models\Course::pluck('department', 'department'),
                ])
                ->rules(['required']),
            //level e.g 4.2
            Select::make('Level')
                ->options([
                    '1.1' => '1.1',
                    '1.2' => '1.2',
                    '2.1' => '2.1',
                    '2.2' => '2.2',
                    '3.1' => '3.1',
                    '3.2' => '3.2',
                    '4.1' => '4.1',
                    '4.2' => '4.2',
                ])
                ->rules(['required']),

                Text::make('Course Code')
                ->rules(['required']),

            Text::make( 'Venue')
                ->rules(['required']),

            Text::make('Time')
                ->rules(['required', 'regex:/^([0-1][0-9]|2[0-3]):([0-5][0-9])$/']),

            Select::make('Day')
                ->options([
                    'monday' => 'Monday',
                    'tuesday' => 'Tuesday',
                    'wednesday' => 'Wednesday',
                    'thursday' => 'Thursday',
                    'friday' => 'Friday',
                ])->hideWhenCreating(),

            Text::make('Duration')
                ->rules(['required', 'regex:/^\d+ (minutes|hours)$/i']),

                Text::make('Lecturer')
                ->rules(['required']),

                Boolean::make('Is Compass Wide','isCampusWide')->sortable()
                ->trueValue('On')
                ->falseValue('Off')->default(0),
                        // isRepeated,
                        Boolean::make('Is Repeated','isRepeated')->sortable()
                ->trueValue('On')
                ->falseValue('Off')->default(0),
                        DateTime::make('Created At')->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [
            ( new Actions\PublishTimetable)->canSee(function ($request){
                return $request->user()->role == 'admin';
               }),
        ];
    }
}
