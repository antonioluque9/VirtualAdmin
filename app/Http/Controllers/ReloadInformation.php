<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Request;

class ReloadInformation extends Controller
{
    //wget --quiet --http-user=root --http-passwd=admin-123 -O prueba
    // 'http://192.168.1.108:10000/virtual-server/remote.cgi?program=list-domains&multiline=&json=1'
    // && mv prueba /home/VirtualAdmin/jsonfiles/prueba

    public function reload($route){
        $servers = App\Models\server::all();
        $functions = ["list-domains", "list-backup-logs"];
        foreach($servers as $server) {
            foreach ($functions as $function){
                $username = $server->name;
                $serverpassword = Crypt::decryptString($server->password);
                $url = "'".$server->url."/virtual-server/remote.cgi?program=".$function."&multiline=&json=1'";
                $filename = $server->url."_".$function;
                $resultado ='bash -c "wget --quiet --http-user='.$username.' -http-passwd='.$serverpassword.' -O '
                .$filename. ' '.$url.' && mv '.$filename.' /home/VirtualAdmin/jsonfiles/'.$filename.'"';
            }
        }
        $explode = explode('{',$route);
        $explode2 = explode('}', $explode[1]);
        //return redirect("/$explode2[0]");
        return $resultado;
    }

    public function upload(){

    }
}
