<?php

    function status($url){
        $todo = explode('/',$url);
        $IpPuerto = explode(':',$todo[2]);
        $salida = [];
        exec('wget --spider http://192.168.1.108:10000 | $?', $salida, $estado);
        if($estado){
            echo "<font color='Green'>Online</font>";
            var_dump($estado);
            var_dump($salida);
        } else {
            echo "<font color='Red'>Offline</font>";
        }
    }

//@fsockopen($IpPuerto[0],$IpPuerto[1],$ERROR_NO,$ERROR_STR,(float)0.5);
