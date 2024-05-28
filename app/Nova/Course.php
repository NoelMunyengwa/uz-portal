<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use App\Nova\Actions;
use Laravel\Nova\Fields\Boolean;
use App\Nova\Metrics;


class Course extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Course>
     */
    public static $model = \App\Models\Course::class;

    // public static function label()
    // {
    //     return 'Lecture Course';
    // }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'course_code';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'department','level','year','course_code','course_title','lecturer','isCampusWide','duration',
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
            ID::make()->sortable()->onlyOnDetail(),
            Select::make('department')->searchable()->options([
                'CS' => ['label' => 'COMPUTER SCIENCE', 'group' => 'FACULTY OF SCIENCE'],
                'ENG' => ['label' => 'ENGINEERING', 'group' => 'FACULTY OF ENGINEERING'],
                'LW' => ['label' => 'LAW', 'group' => 'FACULTY OF LAW'],
                'AC' => ['label' => 'ACCOUNTING', 'group' => 'FACULTY OF MANAGEMENT SCIENCES'],
            ])->displayUsingLabels(),
            Select::make('level')->searchable()->options([
                '1.1' => '1.1',
                '1.2' => '1.2',
                '2.1' => '2.1',
                '2.2' => '2.2',
                '3.1' => '3.1',
                '3.2' => '3.2',
                '4.1' => '4.1',
                '4.2' => '4.2',
                
            ])->displayUsingLabels(),
            Text::make('Year')->sortable()->default(date('Y')),
            Text::make('Course Code')->sortable(),
            Text::make('Course Title')->sortable(),
            Text::make('Lecturer')->sortable(),
            // Text::make('Day')->hideWhenCreating(),
            Select::make('Duration')->searchable()->options([
                '1' => '1 hour',
                '2' => '2 hours',
                '3' => '3 hours',
                '4' => '4 hours',
                
            ])->displayUsingLabels(),
            
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
        return [
            new Metrics\CoursesPerPlan,
            // new Metrics\UsersPerPlan,
        ];
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
           ( new Actions\Course)->canSee(function ($request){
            return $request->user()->role == 'admin';
           }),
        ];
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Courses ';
    }


}
