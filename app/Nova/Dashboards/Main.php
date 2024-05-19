<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;
use App\Nova\Metrics\ResultGradeTrend;
use App\Nova\Metrics\UsersPerPlan;
use App\Nova\Metrics\DegreeProgress;
// use App\Nova\Resources\Student;
use App\Nova\Student;
use Laravel\Nova\Nova;


class Main extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            auth()->user()->role==='user' ?new ResultGradeTrend: new UsersPerPlan,
            
            auth()->user()->role!='user' ? new UsersPerPlan : new DegreeProgress,
            
        ];
    }


    

    //Display student details/resource
     public function resources(){
        Nova::resourcesIn(app_path('Nova'));
        Nova::resources([
            Student::class
        ]);
     }

     //change the title of the dashboard to DASHBOARD
        public function label(){
            return 'Home';
        }

    

}
