<?php

namespace App\Http\Controllers;


class ReloadInformation extends Controller
{
    public function reloadInformation()
    {
	exec('cd ../VirtualAdmin && php artisan command:reload');
	return redirect('backups');
    }
}
