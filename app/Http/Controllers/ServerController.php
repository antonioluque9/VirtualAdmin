<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Input\InputArgument;
use App;
use Illuminate\Support\Facades\Crypt;

class ServerController extends Controller
{
    public function read(){
        //Hay que terminar de hacer algunos ajustes para que con foreach y un solo comando sea capaz de hacer todos los
        //wget(tanto a los diferentes servidores, como las diferentes funciones)
        $servers = App\Models\server::all();

        foreach($servers as $server){
            $serverpassword = Crypt::decryptString($server->password);
        shell_exec("wget --http-user=". $server->name ." --http-passwd=". $serverpassword ." 'https://". $server->url ."/virtual-server/remote.cgi?program=list-domains&&json=1'");
        }
        return view('servers', compact('servers'));
    }

    public function store(Request $request){

        $newserver = new App\Models\server;
        $newserver->url = $request->input('url');
        $newserver->name = $request->input('name');
        $password = $request->input('password');
        $newserver->password = Crypt::encryptString($password);

        $newserver->save();

        return redirect('servers');

    }
}
