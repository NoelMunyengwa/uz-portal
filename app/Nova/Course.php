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
    public static $title = 'department';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'department','semester','year','course_code','course_title','lecturer','day','time','venue',
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
            Select::make('semester')->searchable()->options([
                '1' => 'FIRST SEMESTER',
                '2' => 'SECOND SEMESTER',
                
            ])->displayUsingLabels(),
            Text::make('Year')->sortable(),
            Text::make('Course Code')->sortable(),
            Text::make('Course Title')->sortable(),
            Text::make('Lecturer')->sortable(),
            Text::make('Day')->sortable(),
            Text::make('Time')->sortable(),
            Select::make('venue')->searchable()->options([
                'ONLINE' => 'ONLINE',
                'SOFTWARE LAB' => 'SOFTWARE LAB',
                'HARDWARE LAB' => 'HARDWARE LAB',
                'SEMINAR ROOM' => 'SEMINAR ROOM',
                'SLT500' => 'SLT500',
                'LEWELYN' => 'LEWELYN',
                'AUDITORIUM' => 'AUDITORIUM',
                'MATHS LAB' => 'MATHS LAB',
                
            ])->displayUsingLabels(),
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
        return 'Courses & Timetable';
    }


}
