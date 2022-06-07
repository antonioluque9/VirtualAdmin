<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Virtualhost extends Model
{
    use HasFactory;

    public function getTypeAttribute($value){
        if($value == "Top-level server"){
            return "Principal";
        }elseif($value == "Sub-server"){
            return "SubServidor";
        }else{
            return "Alias";
        }
    }
}
