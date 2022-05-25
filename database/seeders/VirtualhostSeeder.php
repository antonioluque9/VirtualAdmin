<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use App;

class VirtualhostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servers = App\Models\server::all();
        $functions = ["list-domains"];
        foreach ($servers as $server) {
            foreach ($functions as $function) {
                $rutaSeparada = separateRoute($server->url);
                $rutasinpuntos = str_replace('.', '-', $rutaSeparada[0]);
                $filename = '/var/www/html/database/jsonfiles/' . $rutasinpuntos . '-' . $function;
                $jsonfile = File::get($filename);
                $json = json_decode($jsonfile, true);
                foreach ($json['data'] as $data) {
                    if (!App\Models\Virtualhost::find($data['values']['id'][0])) {
                        $virtualhost = new App\Models\Virtualhost();
                        $virtualhost->id = $data['values']['id'][0];
                        $virtualhost->server = $rutaSeparada[0];
                        $virtualhost->servername = $server->servername;
                        $virtualhost->virtualhost = $data['name'];
                        $virtualhost->username = $data['values']['username'][0];
                        $virtualhost->description = $data['values']['description'][0];
                        $virtualhost->save();
                    } else {
                        continue;
                    }
                }
            }
        }
    }
}
