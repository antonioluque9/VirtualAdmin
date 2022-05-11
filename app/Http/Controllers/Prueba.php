<?php

namespace App\Http\Controllers;

use App\Mail\BackupsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Prueba extends Controller
{
    public function Prueba(){
        $failed = DB::table('backups')
            ->where('status', 'FAILED')
            ->where('started', '>', date('Y-m-d',strtotime("-1 days")))->get();
        foreach ($failed as $fail){
            echo $fail->servername;
        }
        Mail::to('antonio.luque@innoforma.com')->queue(new BackupsMail($failed));
    }
}
