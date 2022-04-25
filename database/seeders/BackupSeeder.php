<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use App;

class BackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Hay que añadir algo que borre aquellos backups que se han borrado del servidor
        $servers = App\Models\server::all();
        $functions = ["list-backup-logs"];
        foreach ($servers as $server) {
            foreach ($functions as $function) {
                $ruta = explode('/', $server->url);
                $ruta2 = explode(':', $ruta[2]);
                $rutasinpuntos = str_replace('.', '-', $ruta2[0]);
                $filename = 'C:\xampp\htdocs\VirtualAdmin\database\jsonfiles\\'. $rutasinpuntos . '-' . $function;
                $jsonfile = File::get($filename);
                $json = json_decode($jsonfile, true);
                $separado = array_slice($json['data'], 1);
                foreach ($separado as $data) {
                    $name = str_replace('-', '', $data['name']);
                    $name = explode(':', $name);
                    if (!App\Models\Backup::find($name[0])) {
                        if ($data['values']['final_status'][0] === "OK"){
                            $status = "OK";
                        }else{
                            $status = "FAILED";
                        }
                        $backup = new App\Models\Backup;
                        $backup->id = $name[0];
                        $backup->domain = $rutasinpuntos;
                        $backup->domains = $data['values']['domains'][0];
                        $backup->type = $data['values']['run_from'][0];
                        $backup->status = $status;
                        $backup->failed = $data['values']['failed_domains'][0];
                        $backup->started = $data['values']['started'][0];
                        $backup->ended = $data['values']['ended'][0];
                        if ($status === "OK"){
                            $backup->size = $data['values']['final_nice_size'][0];
                            $backup->save();
                        }else{
                            $backup->save();
                        }
                    } else {
                        continue;
                    }
                }
            }
        }
    }
}
