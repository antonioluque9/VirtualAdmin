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
        $meses = ["Jan"=>"01","Feb"=>"02","Mar"=>"03","Apr"=>"04","May"=>"05","Jun"=>"06","Jul"=>"07","Aug"=>"08",
            "Sep"=>"09", "Oct"=>"10","Nov"=>"11","Dec"=>"12"];
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

                        //Ver la posibilidad de optimizarlo con un foreach
                        $mes1 = explode(' ',$data['values']['started'][0] );
                        $mes2 = explode(' ',$data['values']['ended'][0] );
                        $mesStarted = substr($mes1[0], 3, -5);
                        $mesEnded = substr($mes2[0], 3, -5);
                        $separarFechaInicio = explode('/', $mes1[0]);
                        $separarFechaFin = explode('/', $mes2[0]);
                        $ordenadoInicio = $separarFechaInicio[2]."-".$meses[$mesStarted]."-".$separarFechaInicio[0];
                        $ordenadoFin = $separarFechaFin[2]."-".$meses[$mesEnded]."-".$separarFechaFin[0];

                        $backup = new App\Models\Backup;
                        $backup->id = $name[0];
                        $backup->domain = $rutasinpuntos;
                        $backup->domains = $data['values']['domains'][0];
                        $backup->type = $data['values']['run_from'][0];
                        $backup->status = $status;
                        $backup->failed = $data['values']['failed_domains'][0];
                        $backup->started = $ordenadoInicio." ".$mes1[1];
                        $backup->ended = $ordenadoFin." ".$mes2[1];
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
