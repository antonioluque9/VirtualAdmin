<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use App;

class ReloadInformation extends Controller
{
    public function reloadInformation()
    {
        $this->dispatchSync(new App\Jobs\ReloadInformationSched());
        return redirect('servers');
    }
}
