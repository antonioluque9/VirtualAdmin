<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;

class BackupController extends Controller
{
    public function read(){
        $backups = App\Models\Backup::paginate(10);
        return view('backups', compact('backups'));
    }
//    public function startedDesc(){
//        $backups = App\Models\Backup::orderBy('started','DESC')->paginate(10);
//        return view('backups', compact('backups'));
//    }
//    public function startedAsc(){
//        $backups = App\Models\Backup::orderBy('started','ASC')->paginate(10);
//        return view('backups', compact('backups'));
//    }
//    public function search(Request $request){
//        $search = $request->input('search');
//        $backups = App\Models\Backup::where('server', $search)->paginate(10);
//        return view('backups', compact('backups', 'search'));
//    }
}
