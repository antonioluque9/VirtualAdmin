<?php

namespace App\Http\Controllers;
use App;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function read(){
        $domains = App\Models\Domain::all();
        return view('domains', compact('domains'));
    }
}
