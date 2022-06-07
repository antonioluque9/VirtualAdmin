<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class User extends Controller
{
    public function changemail(Request $request){
        $user = App\Models\User::all()->first();
        $user->email = $request->input('mail');
        $user->save();
        return redirect('servers');
    }
}
