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
                $serverpassword = Crypt::decryptString($server->password);
                shell_exec("wget --http-user=".$server->name." --http-passwd=".$serverpassword." '".$server->url.
                    "/virtual-server/remote.cgi?program=".$function."&multiline=&json=1' >> /home/VirtualAdmin/jsonfiles/".
                    $server->url."_".$function);
            }
        }
        $explode = explode('{',$route);
        $explode2 = explode('}', $explode[1]);
        return redirect("/$explode2[0]");
    }

    public function upload(){

    }
}
