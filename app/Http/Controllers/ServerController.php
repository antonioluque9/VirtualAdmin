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
        $user = App\Models\User::all();
        return view('servers', compact('servers', 'user'));
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

    public function editname(Request $request){
        $server = App\Models\server::find($request->input('id'));

        $virtualhosts = DB::table('virtualhosts')->where('servername', $server->servername)->get();
        foreach ($virtualhosts as $virtualhost){
            $server1 = App\Models\Virtualhost::find($virtualhost->id);
            $server1->servername = $request->input('newname');
            $server1->save();
        }
        $backups = DB::table('backups')->where('servername', $server->servername)->get();
        foreach ($backups as $backup){
            $server2 = App\Models\Backup::find($backup->id);
            $server2->servername = $request->input('newname');
            $server2->save();
        }

        $server->servername = $request->input('newname');
        $server->save();

        return redirect('servers');
    }

    public function update(Request $request){
        if (!DB::table('servers')->where('url', $request->input('url'))->whereNot('id', $request->input('id'))->first()){
            if (!DB::table('servers')->where('servername', $request->input('servername'))->whereNot('id', $request->input('id'))->first()){
                $server = App\Models\server::find($request->input('id'));
                $server->url = $request->input('url');
                $server->username = $request->input('username');

		$virtualhosts = DB::table('virtualhosts')->where('servername', $server->servername)->get();
                foreach ($virtualhosts as $virtualhost){
                    $server1 = App\Models\Virtualhost::find($virtualhost->id);
                    $server1->servername = $request->input('servername');
                    $server1->save();
                }
                $backups = DB::table('backups')->where('servername', $server->servername)->get();
                foreach ($backups as $backup){
                    $server2 = App\Models\Backup::find($backup->id);
                    $server2->servername = $request->input('servername');
                    $server2->save();
                }

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
