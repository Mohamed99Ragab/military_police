<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('backup:clean')->weekly();
        $schedule->command('backup:run')->daily()->at('24:00')
            ->onFailure(function () {
               info(__('backup daily at :date failure',['date'=>Carbon::today()->format('d/m/y H:i')]));
            })
            ->onSuccess(function () {
                info(__('backup daily at :date success',['date'=>Carbon::today()->format('d/m/y H:i')]));

            });
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
