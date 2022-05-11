<?php
    function status($url){
        $todo = explode('/',$url);
        $IpPuerto = explode(':',$todo[2]);
        $estado = @fsockopen($IpPuerto[0],$IpPuerto[1],$ERROR_NO,$ERROR_STR,(float)0.5);
        if($estado){
            return "Online";
        } else {
            return "Offline";
        }
    }
    function separateRoute($ruta){
        $separateRoute = explode('/', $ruta);
        return explode(':', $separateRoute[2]);
    }
    function idServidor($url){
        return str_replace('.', '', separateRoute($url))[0].separateRoute($url)[1];
    }
    function transformDate($date){
        $meses = ["Jan"=>"01","Feb"=>"02","Mar"=>"03","Apr"=>"04","May"=>"05","Jun"=>"06","Jul"=>"07","Aug"=>"08",
            "Sep"=>"09", "Oct"=>"10","Nov"=>"11","Dec"=>"12"];
        $separarFechaHora = explode(' ',$date );
        $mes = substr($separarFechaHora[0], 3, -5);
        $separarFecha = explode('/', $separarFechaHora[0]);
        $fechaOrdenada = $separarFecha[2]."-".$meses[$mes]."-".$separarFecha[0]." ".$separarFechaHora[1];
        return $fechaOrdenada;
    }
