<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Menu\MenuItem;
use App\Nova\Dashboards\Main;
use App\Nova\Course;
use App\Nova\CourseConfirmation;
// use App\Nova\CourseRegistration;
use App\Nova\CoursesOnOffer;
use App\Nova\Registration;
use App\Nova\RegistrationHistory;
// use App\Nova\RegistrationStatus;
use App\Nova\ExamTimetable;
use App\Nova\Results;
use App\Nova\Statement;
use App\Nova\Invoice;
use App\Nova\Quotation;
use App\Nova\EcocashPayment;
use App\Nova\PaynowPayment;
use App\Nova\Timetable;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::footer(
            function ($request){
                return Blade::render('<div style="text-align: center;">Powered by <strong>Noel Munyengwa</strong></div>');
            }
        );
        Nova::showUnreadCountInNotificationCenter();

        //Customizing the Main Menu 
        Nova::mainMenu(
            function(Request $request){
                return [
                    MenuSection::dashboard(Main::class)->icon('home'),
                    MenuSection::make('Payments & Statements', [
                        MenuItem::resource(EcocashPayment::class),
                        MenuItem::resource(PaynowPayment::class),
                        MenuItem::resource(Quotation::class),
                        MenuItem::resource(Invoice::class),
                        MenuItem::resource(Statement::class),

                    ])->icon('credit-card')->collapsable(),
    
                    MenuSection::make('Courses & Registration', [
                        MenuItem::resource(Course::class),
                        MenuItem::resource(CourseConfirmation::class),
                        // MenuItem::resource(CourseRegistration::class),
                        MenuItem::resource(CoursesOnOffer::class),
                        MenuItem::resource(Registration::class),
                        // MenuItem::resource(Results::class),
                        MenuItem::resource(RegistrationHistory::class),
                        MenuItem::resource(Timetable::class),
                    ])->icon('book-open')->collapsable(),

                    MenuSection::make('Exams & Results', [
                        MenuItem::resource(ExamTimetable::class),
                        MenuItem::resource(Results::class),
                        // MenuItem::resource(ExamRegistration::class),
                        // MenuItem::resource(ExamRegistrationHistory::class),
                        // MenuItem::resource(ExamRegistrationStatus::class),
                    ])->icon('clipboard-list')->collapsable(),

                    

          
                ]; 
            }
        );

    
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
