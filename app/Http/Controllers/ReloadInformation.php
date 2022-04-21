<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class ReloadInformation extends Controller
{
    public function reload($route){
        $servers = App\Models\server::all();
        $functions = ["list-domains", "list-backup-logs"];
        foreach($servers as $server) {
            foreach ($functions as $function){
                $ruta = explode('/', $server->url);
                $ruta2 = explode(':', $ruta[2]);
                $rutasinpuntos = str_replace('.', '-', $ruta2[0]);
                $username = $server->name;
                $serverpassword = Crypt::decryptString($server->password);
                $url = "'".$server->url."/virtual-server/remote.cgi?program=".$function."&multiline=&json=1'";
                $filename = $rutasinpuntos."-".$function;
                shell_exec('bash -c "cd /home/VirtualAdmin/jsonfiles && wget -q -b --user='.$username.' --password='.$serverpassword.' -O '
                .$filename. ' '.$url.'"');
            }
        }
        $explode = explode('{',$route);
        $explode2 = explode('}', $explode[1]);
        return redirect("/$explode2[0]");
    }

    public function upload(){

    }
}
