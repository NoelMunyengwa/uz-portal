<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Notifications\NovaNotification;
use App\Models\User;
use App\Models\Timetable;
use Laravel\Nova\URL;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;



class PublishTimetable extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields,  Collection $models)
    {
        //Notifying all users with role == 'admin' that the timetable has been published
        $pdf = Pdf::loadView('pdf.timetable', ['models' => $models]);
        $filename = 'Lecture Timetable_' . time() . '.pdf';
        Storage::put('pdfs/' . $filename, $pdf->stream());
        $url = route('download.pdf', ['filename' => $filename]);
        $departments = $models->pluck('department')->unique();

        // Notifying users belonging to each department
        foreach ($departments as $department) {
            $users = User::where('department', $department)
                ->orWhere('role', 'admin') // Add this line to include admin users
                ->get();
            foreach ($users as $user) {
                if ($user->role === 'admin' || $user->department === $department) {
                    $user->notify(NovaNotification::make()
                        ->message('Timetable was published for ' . $department)
                        ->action('Download', URL::remote($url))
                        ->openInNewTab()
                        ->icon('download')
                        ->type('info'));
                }
            }
        }

        // $users = User::all();
        // foreach ($users as $user) {
        //     if ($user->role === 'student' || $user->role === 'user' || $user->role === 'admin') {//filter by user programm
        //         $user->notify(NovaNotification::make()
        //         ->message('Timetable was published!')
        //         ->action('Download', URL::remote($url))
        //         ->openInNewTab()
        //         ->icon('download')
        //         ->type('info'));
        //     }
        // }
    }
    //New name
    public function name()
    {
        return __('Publish Timetable');
    }

    //confirmation message
    public function confirmationMessage()
    {
        return __('Are you sure you want to publish this timetable?');
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
