<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    protected $fillable = ['type'];

    public function getTypeAttribute($value){
        if ($value == "sched"){
            return $this->type = "Programado";
        }else{
            return $this->type = "Manual";
        }
    }
    public function getDomainsAttribute($value){
        $dominios = explode( ' ', $value);
        foreach ($dominios as $dominio){
            echo $dominio."<br>";
        }
    }
    public function getStartedAttribute($value){
        $started = explode(':', $value);
        return $started[0].":".$started[1];
    }
    public function getEndedAttribute($value){
        $ended = explode(':', $value);
        return $ended[0].":".$ended[1];
    }
}
