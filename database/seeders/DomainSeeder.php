<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use App;

class DomainSeeder extends Seeder
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
                $ruta = explode('/', $server->url);
                $ruta2 = explode(':', $ruta[2]);
                $rutasinpuntos = str_replace('.', '-', $ruta2[0]);
                $filename = 'C:\xampp\htdocs\VirtualAdmin\database\jsonfiles\\' . $rutasinpuntos . '-' . $function;
                $jsonfile = File::get($filename);
                $json = json_decode($jsonfile, true);
                foreach ($json['data'] as $data) {
                    if (!App\Models\Domain::find($data['name'])) {
                        $domain = new App\Models\Domain;
                        $domain->id = $data['name'];
                        $domain->server = $rutasinpuntos;
                        $domain->username = $data['values']['username'][0];
                        $domain->description = $data['values']['description'][0];
                        $domain->save();
                    } else {
                        continue;
                    }
                }
            }
        }
    }
}
