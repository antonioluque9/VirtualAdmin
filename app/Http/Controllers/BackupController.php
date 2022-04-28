<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class BackupController extends Controller
{
    public function read(){
        $backups = App\Models\Backup::all();
        return view('backups', compact('backups'));
    }
    public function startedDesc(){
        $backups = App\Models\Backup::orderBy('started','DESC')->get();
        return view('backups', compact('backups'));
    }
}
