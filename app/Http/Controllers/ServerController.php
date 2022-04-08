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

        $servers = App\Models\server::all();
        return view('servers', compact('servers'));
    }

    public function store(Request $request){

        $newserver = new App\Models\server;
        $newserver->url = $request->input('url');
        $newserver->name = $request->input('name');
        $password = $request->input('password');
        $newserver->password = Crypt::encrypt($password);

        $newserver->save();

        return redirect('servers');

    }
}
