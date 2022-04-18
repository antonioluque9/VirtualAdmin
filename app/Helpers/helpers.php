<?php

    function status($url){
        $todo = explode('/',$url);
        $IpPuerto = explode(':',$todo[2]);
        $estado = @fsockopen($IpPuerto[0],$IpPuerto[1],$ERROR_NO,$ERROR_STR,(float)0.5);
        if($estado){
            echo "<font color='Green'>Online</font>";
        } else {
            echo "<font color='Red'>Offline</font>";
        }
    }

//@fsockopen($IpPuerto[0],$IpPuerto[1],$ERROR_NO,$ERROR_STR,(float)0.5);
