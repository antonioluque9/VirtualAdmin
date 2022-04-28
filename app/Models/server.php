<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class server extends Model
{
    use HasFactory;

    protected $table = 'servers';
    protected $fillable = ['url', 'name'];
    protected $hidden = 'password';
    protected $guarded = 'id';

}
