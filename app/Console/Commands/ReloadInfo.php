<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Crypt;
use App;

class ReloadInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:reload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reload de information of the web';

    /**
     * Execute the console command.
     *
     * @return int
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
                exec('cd /var/www/html/database/jsonfiles && wget --no-check-certificate --user='.$username.' --password='.$serverpassword.' -O '
                    .$filename. ' '.$url.'');
            }
        }
        exec('cd /var/www/html && php artisan db:seed --class=BackupSeeder && php artisan db:seed --class=VirtualhostSeeder');
    }
}
