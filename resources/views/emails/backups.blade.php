<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mail</title>
</head>
<body>
    <h2>Los siguientes backups han fallado</h2>
    @foreach($failed as $fail)
        <ul>{{$fail->servername}}
            <li>Virtualhosts afectados: {{$fail->domains}}</li>
            <li>Tipo: {{$fail->type}}</li>
            <li>Fecha y Hora: {{$fail->started}}</li>
        </ul>
    @endforeach
</body>
</html>
