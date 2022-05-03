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
                $rutaSeparada = separateRoute($server->url);
                $rutasinpuntos = str_replace('.', '-', $rutaSeparada[0]);
                $filename = 'C:\xampp\htdocs\VirtualAdmin\database\jsonfiles\\' . $rutasinpuntos . '-' . $function;
                $jsonfile = File::get($filename);
                $json = json_decode($jsonfile, true);
                foreach ($json['data'] as $data) {
                    if (!App\Models\Domain::find($data['values']['id'][0])) {
                        $domain = new App\Models\Domain;
                        $domain->id = $data['values']['id'][0];
                        $domain->server = $rutasinpuntos;
                        $domain->domain = $data['name'];
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
