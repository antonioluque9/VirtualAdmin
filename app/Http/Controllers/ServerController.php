<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Illuminate\Support\Facades\Crypt;

class ServerController extends Controller
{
    public function read(){
        $servers = App\Models\server::all();
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
        $server -> delete();
        return redirect('servers');
    }
}
