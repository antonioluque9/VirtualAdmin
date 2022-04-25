<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App;
use Database;


class PruebaController extends Controller
{
    public function prueba()
    {
        //Arreglar la busqueda de la columna domain para evitar la repeticion de datos
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

                    print($data['values']['username'][0]);

                    if (!App\Models\Domain::where('domain',$data['name']) === $data['name']) {

                        $domain = new App\Models\Domain;
                        $domain->domain = $data['name'];
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
