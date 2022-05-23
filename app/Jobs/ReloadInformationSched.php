<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use App;

class ReloadInformationSched implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
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
                $url = "'".$server->url."/virtual-server/remote.cgi?program=".$function."&multiline=&json=1'";
                $filename = $rutasinpuntos."-".$function;
                exec('bash -c "cd database/jsonfiles && wget -q -b --no-check-certificate --user='.$username.' --password='.$serverpassword.' -O '
                    .$filename. ' '.$url.'"');
            }
        }
        exec('bash -c "php artisan db:seed --class=BackupSeeder && php artisan db:seed --class=VirtualhostSeeder"');
    }
}
