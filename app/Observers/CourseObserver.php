<?php

namespace App\Observers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\URL;
use Laravel\Nova\Notifications\NovaNotification;




class CourseObserver
{

    /**
     * Handle the Course "created" event.
     */
    public function created(Course $course): void
    {
        $users = User::all();
        foreach ($users as $user) {
            if ( $user->role === 'admin') {
                $user->notify(NovaNotification::make()
                ->message('Your Course '.$course->course_code.' is now available ')
                // ->action('Download', URL::remote('https://stackoverflow.com/questions/54234808/laravel-5-4-shouldqueue-not-sending-email'))
                // ->openInNewTab()
                ->icon('download')
                ->type('success'));
            }
        }
    }

    /**
     * Handle the Course "updated" event.
     */
    public function updated(Course $course): void
    {
        $users = User::all();
        foreach ($users as $user) {
            if ($user->role === 'student' || $user->role === 'user' || $user->role === 'admin') {//filter by user programm
                $user->notify(NovaNotification::make()
                ->message('Your Course '.$course->course_code.' was updated!')
                // ->action('Download', URL::remote('https://stackoverflow.com/questions/54234808/laravel-5-4-shouldqueue-not-sending-email'))
                // ->openInNewTab()
                ->icon('information-circle')
                ->type('warning'));
            }
        }
    }

    /**
     * Handle the Course "deleted" event.
     */
    public function deleted(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "restored" event.
     */
    public function restored(Course $course): void
    {
        //
    }

    /**
     * Handle the Course "force deleted" event.
     */
    public function forceDeleted(Course $course): void
    {
        //
    }
}
