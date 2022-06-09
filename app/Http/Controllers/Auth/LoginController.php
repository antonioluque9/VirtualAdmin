<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Concerns\HasGlobalScopes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function register(Request $request){
        if(!App\Models\User::all()->first()){
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'confirm-password' => 'required|same:password'
        ]);
        $data = $request->except('confirm-password', 'password');
        $data['password'] = Hash::make($request->password);
        App\Models\User::create($data);

        return redirect('/');
        }else{
            throw \Illuminate\Validation\ValidationException::withMessages(
                ['name' => ['No se puede registrar mas de un usuario']]);
        }
    }

    public function changepasswd(Request $request){
        if(!Hash::check($request->input('currentpassword'), auth()->user()->password)){
            return redirect('servers')->with('error', 'La contraseña actual no coincide');
        }

        if($request->input('newpassword') == $request->input('confirm-newpassword')){
        $validation = $request->validate([
            'newpassword' => 'required',
            'confirm-newpassword' => 'required|same:newpassword'
        ]);}else{
            return redirect('servers')->with('error', 'La nueva contraseña no coincide');
        }

        App\Models\User::whereId(auth()->user()->id)->update([
           'password' => Hash::make($request->newpassword)
        ]);
        return redirect('servers')->with('status', 'La contraseña se ha cambiado');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required','string'],
            'password' => ['required', 'string']]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect('/servers');
        }

        throw \Illuminate\Validation\ValidationException::withMessages([
            'name' => __('auth.failed')
        ]);
    }

    public function logout(Request $request){

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
