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
        if (!App\Models\server::find(idServidor($request->input('url')))) {
            $newserver = new App\Models\server;
            $newserver->id = idServidor($request->input('url'));
            $newserver->url = $request->input('url');
            $newserver->name = $request->input('name');
            $password = $request->input('password');
            $newserver->password = Crypt::encryptString($password);
            $newserver->save();
        }else{
            throw \Illuminate\Validation\ValidationException::withMessages([
                'name' => ['Ese servidor ya esta incluido en la base de datos']
            ]);
        }
        return redirect('servers');

    }

    public function edit($id){
        $server = App\Models\server::find($id);
        return view('editserver', compact('server'));
    }

    public function update(Request $request){
        $server = App\Models\server::find($request->input('id'));
        $server->url = $request->input('url');
        $server->name = $request->input('name');
        $password = $request->input('password');
        $server->password = Crypt::encryptString($password);

        $server->save();

        return redirect('servers');
    }

    public function delete($id){
        $server = App\Models\server::find($id);
        $ruta = separateRoute($server->url);
        $rutasinpuntos = str_replace('.', '-', $ruta[0]);

        $domains = DB::table('domains')->where('server', $ruta[0])->get();
        $numeroDomains = DB::table('domains')->where('server', $ruta[0])->count();
        for ($i=0;$i<$numeroDomains;$i++){
            $domain = App\Models\Domain::find($domains[$i]->id);
            $domain -> delete();
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
