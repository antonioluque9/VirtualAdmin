<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mail</title>
</head>
<body>
    <p>Los siguientes backups han fallado o no se han realizado correctamente:</p>
    @foreach($failed as $fail)
        <br>
        <h4>Servidor: {{$fail->servername}}</h4>
        <ul>
            <li><b>Estado:</b> {{$fail->status}}</li>
            @if($fail->status === "PARTIAL")
                <li><b>Virtualhosts:</b> {{$fail->domains}}</li>
                <li><b>Virtualhosts fallidos:</b> {{$fail->failed}}</li>
            @else
                <li><b>Virtualhosts afectados:</b> {{$fail->domains}}</li>
            @endif
            <li><b>Tipo:</b> {{$fail->type}}</li>
            <li><b>Fecha y Hora:</b> {{$fail->started}}</li>
        </ul>
    @endforeach
</body>
</html>
