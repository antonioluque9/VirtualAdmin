<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App;

class ReloadInformation extends Controller
{
    public function reloadInformation()
    {
        new App\Jobs\ReloadInformation();
        return redirect('servers');
    }
}
