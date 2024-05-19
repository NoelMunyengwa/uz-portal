<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;

class Student extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Student>
     */
    public static $model = \App\Models\Student::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reg_number';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reg_number', 'surname', 'first_name', 'faculty', 'programme_code', 'programme_name', 'mobile', 'email', 'registration_status', 'programme_start_year', 'current_year', 'id_Number', 'initial', 'dob', 'year_of_tudy', 'semester', 'address', 'sponsor', 'barcode', 'years_till_time_out',
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
            Text::make('reg_number'),
            Text::make('surname'),
            Text::make('first_name'),
            Text::make('faculty'),
            Text::make('programme_code'),
            Text::make('programme_name'),
            Text::make('mobile'),
            Text::make('email'),
            Text::make('registration_status'),
            Text::make('programme_start_year'),
            Text::make('current_year'),
            Text::make('id_Number'),
            Text::make('initial'),
            Text::make('dob'),
            Text::make('year_of_tudy'),
            Text::make('semester')->sortable(),
            Text::make('address'),
            Text::make('sponsor'),
            Text::make('barcode'),
            Text::make('years_till_time_out'),

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
        return [];
    }
}
