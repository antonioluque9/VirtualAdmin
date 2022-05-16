<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Crypt;
use App;

class ReloadInformation extends Controller
{
    public function reloadInformation()
    {
        App\Jobs\ReloadInformationSched::dispatch();
        return redirect('servers');
    }
}
