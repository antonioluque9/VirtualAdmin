<?php

namespace App\Console;

use App\Mail\BackupsMail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Crypt;
use App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Console\Commands\SendEmailsCommand;

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
        $servers = App\Models\server::all();
        $functions = ["list-domains", "list-backup-logs"];
        foreach($servers as $server) {
            foreach ($functions as $function){
                $ruta = explode('/', $server->url);
                $ruta2 = explode(':', $ruta[2]);
                $rutasinpuntos = str_replace('.', '-', $ruta2[0]);
                $username = $server->username;
                $serverpassword = Crypt::decryptString($server->password);
                if($function === "list-domains"){
                    $url = "'".$server->url."/virtual-server/remote.cgi?program=".$function."&json=1&simple-multiline'";
                }else{
                    $url = "'".$server->url."/virtual-server/remote.cgi?program=".$function."&multiline=&json=1'";
                }
                $filename = $rutasinpuntos."-".$function;
                $schedule->exec('bash -c "cd /home/VirtualAdmin/jsonfiles && wget -q -b --no-check-certificate --user='.$username.' --password='.$serverpassword.' -O '
                    .$filename. ' '.$url.'"')->everyFiveMinutes();
            }
        }
        $schedule->job(new App\Jobs\EmailSending())->dailyAt('9:00');
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
