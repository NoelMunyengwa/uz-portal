<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use App\Nova\Metrics\ResultGradeTrend;

class UserProfile extends Dashboard
{

    /**
 * Get the displayable name of the dashboard.
 *
 * @return string
 */
public function name()
{
    return 'Student Profile';
}
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            ResultGradeTrend::make()

        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'user-profile';
    }
}
