<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Nette\Schema\ValidationException;

class LoginController extends Controller
{
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
