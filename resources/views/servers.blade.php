<!DOCTYPE html>
<html lang=es>
    <head>
        <meta charset="utf-8"/>
        <link rel="shortcut icon" href="{{ asset('img/inno.ico') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
        <title>VirtualAdmin</title>
    </head>
    <body>
        @include('partials.nav')
        <div class="container-xl pt-2 fs-5">
            <div class="mt-5 pt-3">
                @if( session('status'))
                    <div class="alert alert-success h-auto" role="alert">
                        {{ session('status') }}
                    </div>
                @elseif( session('error'))
                    <div class="alert alert-danger h-auto" role="alert">
                        {{ session('error') }}
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger h-auto">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                    </div>
                @endif
            </div>
            @foreach($user as $user)
            <div class="float-start "><p>Correo: {{$user->email}}</p></div>
            @endforeach
            <div class="float-end mb-3">
                <button class="mx-auto btn btn-primary" type="submit">
                    <a href="/reload" class="text-decoration-none text-white">
                        Recargar Información
                    </a>
                </button>
            </div>
            <table class="table align-middle mb-0 mt-3 bg-white">
                <thead class="bg-light">
                <tr>
                    <th class="col-md-4">Servidor</th>
                    <th class="col-md-4 text-center">Url</th>
                    <th class="col-md-2">Estado</th>
                    <th><div class="text-center">Acciones</div></th>
                </tr>
                </thead>
                <tbody>
                @foreach($servers as $server)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="ms-3">
                                    <p class="mb-1">{{$server->servername}}<button class="border-0 bg-body text-secondary" data-bs-toggle="modal" data-bs-target="#{{$server->servername}}"><i class="bi-pencil-square" style="font-size: 15px"></i></button></p>
                                </div>
                            </div>

                            <div class="modal fade" id="{{$server->servername}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Cambiar Nombre</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="get" action="/newserver/editname">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$server->id}}"/>
                                                <input type="text" name="newname" required autofocus class="m-2 mb-3 form-control"/>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="text-center">{{$server->url}}</td>
                        <td>
                            @if ( status($server->url) == "Online")
                                <span class="badge rounded-pill bg-success">Online</span>
                            @else
                                <span class="badge rounded-pill bg-danger">Offline</span>
                            @endif
                        </td>
                        <td>
                            <form method="post" action="">
                                @csrf
                                <button type="button" class="btn btn-success btn-sm btn-rounded">
                                    <a class="text-decoration-none text-white" target="_blank" href="{{$server->url}}">Acceder</a>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm btn-rounded">
                                    <a class="text-decoration-none text-white" href="/newserver/edit/{{{$server->id}}}">Editar</a>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded">
                                    <a class="text-decoration-none text-white" href="/newserver/delete/{{{$server->id}}}" onclick="return confirm('Seguro que deseas elimiar el servidor {{$server->servername}}')">Borrar</a>
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
