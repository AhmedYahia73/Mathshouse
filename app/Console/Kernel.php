<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
         $schedule->command('tokens:cleanup')->daily();
             $schedule->command(command: 'exchange-rates:update')->hourly(); // Run hourly

     }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
        protected $commands = [
            \App\Console\Commands\CleanupExpiredTokens::class,
            \App\Console\Commands\UpdateExchangeRates::class,
        ];

}
