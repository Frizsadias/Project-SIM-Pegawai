<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\ProfileInformation;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */

    // protected function schedule(Schedule $schedule)
    // {
    //     // $schedule->command('inspire')->hourly();
    //     $schedule->call(function () {
    //         $profilInformation = ProfileInformation::all();
    
    //         foreach ($profilInformation as $ulangtahun) {
    //             if ($ulangtahun->tgl_lahir->format('m-d') == now()->format('m-d')) {
    //                 $ulangtahun->notify(new UlangTahunNotification($ulangtahun));
    //             }
    //         }
    //     })->daily();
    // }

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $profileInformation = ProfileInformation::all();

            foreach ($profileInformation as $ultahuser) {
                $today = now();
                $birthdate = $ultahuser->tgl_lahir;

                if ($today->format('m-d') === $birthdate->format('m-d')) {
                    $ultahuser->notify(new UlangTahunNotification($ultahuser));
                }
            }
        })->yearly();
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
