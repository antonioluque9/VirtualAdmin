<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function resgister(Request $request){
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
