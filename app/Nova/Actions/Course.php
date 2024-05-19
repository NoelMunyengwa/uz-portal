<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Actions\ActionResponse;
use Illuminate\Support\Facades\Http;

// use Illuminate\Foundation\Actions\Dispatchable;

class Course extends Action 
{
    use InteractsWithQueue, Queueable;


  

    public function uriKey()
    {
        return 'AUTO CREATE TIMETABLE';
    }

    public function label()
    {
        return 'AUTO CREATE TIMETABLE';
    }

    public function onResourceSelected(ActionField $field, $model)
    {
        // Implement logic to determine which resources to send (optional)

        // You can access selected resources using $field->resources

        return ActionField::available();
    }

    public function handle(ActionFields $fields, Collection $models)
    {
        // foreach ($models as $model) {
        //     // Implement logic to send data to the API (optional)
        //     $dummy = Http::get('http://127.0.0.1:5000/get_data');
        //     return ActionResponse::message('It worked!');
        // }
        // $dummy = Http::get('http://127.0.0.1:5000/get_data');
        $postData = collect($models) // Assuming you want to send data for all selected resources
            ->map(function ($model) {
                return [
                    
                    'courses' => $model->course_code,
                    'durations' => $model->time,
                    'lecturers' => $model->lecturer,
                    // 'name' => $model->name, // Replace with the appropriate field name
                    // 'duration' => $model->duration, // Replace with the appropriate field name
                ];
            })
            ->toArray();

        $response = $this->sendToAPI($postData);

        if ($response->successful()) {
            return Action::message('Timetable created successfully!');
        } else {
            return Action::message('Something went wrong!');
        }
    }

    private function sendToAPI(array $data)
    {
        $url = 'http://127.0.0.1:5000/genetic_timetable';
        // $url = 'https://pythonantcolony.onrender.com/generate_timetable/generate_timetable'; // Replace with the actual API endpoint
        $headers = [
            'Content-Type' => 'application/json',
            // Add any additional headers required by the API
        ];

        return Http::withHeaders($headers)->post($url, json_encode($data));
    }

    public $name = 'AUTO CREATE TIMETABLE';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    // public function handle(ActionFields $fields, Collection $models)
    // {
    //     //
    // }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            
        ];
    }
}
