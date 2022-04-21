<!DOCTYPE html>
<html lang=es>
    <head>
        <meta charset="utf-8"/>
        <link rel="shortcut icon" href="{{ asset('img/inno.ico') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <title>VirtualAdmin</title>
    </head>
    <body>
        @include('partials.nav')
        <div class="container-xl">

            <table class="table align-middle mb-0 mt-5 bg-white">
                <thead class="bg-light">
                <tr>
                    <th>Ruta</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($servers as $server)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="mb-1">{{$server->url}}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge badge-success rounded-pill d-inline">{{status($server->url)}}</span>
                        </td>
                        <td>
                            <form method="post" action="">
                                <button type="button" class="btn btn-link btn-sm btn-rounded">
                                    <a target="_blank" href="{{$server->url}}">Acceder</a>
                                </button>
                                <button type="button" class="btn btn-link btn-sm btn-rounded">
                                    <a href="/newserver/edit/{{{$server->id}}}">Editar</a>
                                </button>
                                <button type="button" class="btn btn-link btn-sm btn-rounded">
                                    <a href="/newserver/delete/{{{$server->id}}}" onclick="return confirm('Seguro que deseas elimiar el servidor {{$server->url}}')">Borrar</a>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
