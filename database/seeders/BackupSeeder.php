<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;
use App;
use Illuminate\Support\Facades\DB;

class BackupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servers = App\Models\server::all();
        $functions = ["list-backup-logs"];
        foreach ($servers as $server) {
            foreach ($functions as $function) {
                $rutaSeparada = separateRoute($server->url);
                $rutasinpuntos = str_replace('.', '-', $rutaSeparada[0]);
                $filename = 'C:\xampp\htdocs\VirtualAdmin\database\jsonfiles\\'. $rutasinpuntos . '-' . $function;
                $jsonfile = File::get($filename);
                $json = json_decode($jsonfile, true);
                $separado = array_slice($json['data'], 1);
                foreach ($separado as $data) {
                    $name = str_replace('-', '', $data['name']);
                    $name = explode(':', $name);

                    if (!App\Models\Backup::find($name[0])) {
                        if (($data['values']['started'][0]) <= (date('Y-M-d H:i',strtotime("-1 month")))){
                            $backup = new App\Models\Backup;
                                if ($data['values']['final_status'][0] === "OK"){
                                    if(isset($data['values']['failed_domains'][0])){
                                        if(strlen($data['values']['failed_domains'][0]) === strlen($data['values']['domains'][0])){
                                            $backup->failed = $data['values']['failed_domains'][0];
                                            $status = "FAILED";
                                        }else{
                                            $status = "PARTIAL";
                                            $backup->failed = $data['values']['failed_domains'][0];
                                        }
                                    }else{
                                        $backup->failed = "";
                                        $status = "OK";
                                    }
                                }else{
                                    $backup->failed = $data['values']['failed_domains'][0];
                                    $status = "FAILED";
                                }

                            $backup->id = $name[0];
                            $backup->server = $rutaSeparada[0];
                            $backup->domains = $data['values']['domains'][0];
                            $backup->servername = $server->servername;
                            $backup->type = $data['values']['run_from'][0];
                            $backup->status = $status;

                            $backup->started = transformDate($data['values']['started'][0]);
                            $backup->ended = transformDate($data['values']['ended'][0]);
                            if ($status === "OK" or $status === "PARTIAL"){
                                $backup->size = $data['values']['final_nice_size'][0];
                                $backup->save();
                            }else{
                                $backup->save();
                            }
                        }else{
                            continue;
                        }
                    } else {
                        continue;
                    }
                }
            }
        }
    }
}
