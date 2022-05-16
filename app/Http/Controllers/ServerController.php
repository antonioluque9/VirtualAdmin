<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Nette\Schema\ValidationException;

class ServerController extends Controller
{
    public function read(){
        $servers = App\Models\server::all();
        return view('servers', compact('servers'));
    }

    public function store(Request $request)
    {
        if (!DB::table('servers')->where('url', $request->input('url'))->first()){
            if (!DB::table('servers')->where('servername', $request->input('servername'))->first()){
                $newserver = new App\Models\server;
                $newserver->url = $request->input('url');
                $newserver->username = $request->input('username');
                $newserver->servername = $request->input('servername');
                $password = $request->input('password');
                $newserver->password = Crypt::encryptString($password);
                $newserver->save();
                new App\Jobs\ReloadInformation();
                }else{
                    throw \Illuminate\Validation\ValidationException::withMessages(
                        ['name' => ['No se puede repetir el nombre de un servidor']]);
                }
            }else{
                throw \Illuminate\Validation\ValidationException::withMessages(
                    ['name' => ['Ese servidor ya esta incluido en la base de datos']]);
            }
        return redirect('servers');
    }


    public function edit($id){
        $server = App\Models\server::find($id);
        return view('editserver', compact('server'));
    }

    public function update(Request $request){
        if (!DB::table('servers')->where('url', $request->input('url'))->whereNot('id', $request->input('id'))->first()){
            if (!DB::table('servers')->where('servername', $request->input('servername'))->whereNot('id', $request->input('id'))->first()){
                $server = App\Models\server::find($request->input('id'));
                $server->url = $request->input('url');
                $server->username = $request->input('username');
                $server->servername = $request->input('servername');
                $password = $request->input('password');
                $server->password = Crypt::encryptString($password);
                $server->save();
                }else{
                    throw \Illuminate\Validation\ValidationException::withMessages(
                        ['name' => ['No se puede repetir el nombre de un servidor']]);
                }
            }else{
                throw \Illuminate\Validation\ValidationException::withMessages(
                    ['name' => ['Ese servidor ya esta incluido en la base de datos']]);
            }
        return redirect('servers');
    }

    public function delete($id){
        $server = App\Models\server::find($id);
        $ruta = separateRoute($server->url);
        //$rutasinpuntos = str_replace('.', '-', $ruta[0]);

        $virtualhosts = DB::table('virtualhosts')->where('server', $ruta[0])->get();
        $numeroVirtualhosts = DB::table('virtualhosts')->where('server', $ruta[0])->count();
        for ($i=0;$i<$numeroVirtualhosts;$i++){
            $virtualhost = App\Models\Virtualhost::find($virtualhosts[$i]->id);
            $virtualhost -> delete();
        }

        $backups = DB::table('backups')->where('server', $ruta[0])->get();
        $numeroBackups = DB::table('backups')->where('server', $ruta[0])->count();
        for ($i=0;$i<$numeroBackups;$i++){
            $backup = App\Models\Backup::find($backups[$i]->id);
            $backup -> delete();
        }

        $server -> delete();
        return redirect('servers');
    }
}
