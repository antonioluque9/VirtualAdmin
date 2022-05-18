<?php

namespace App\Http\Controllers;


class ReloadInformation extends Controller
{
    public function reloadInformation()
    {
        \Artisan::call('command:reload');
        return redirect('servers');
    }
}
