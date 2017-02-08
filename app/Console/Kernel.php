<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Datasource;
use App\CacheDatasourceStats;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
   
        $schedule->call(function(){
            foreach (Datasource::all() as $datasource) { 
                print "Syncing ". $datasource->name . "\n";
                $ret=$datasource->syncschedule();
                print $ret . "\n";
            }
        })->everyMinute();

      
        $schedule->call(function(){
            DB::table('cache_datasource_stats')->whereRaw("created_at < now() - interval '24 hours'")->delete();
        })->daily();

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
