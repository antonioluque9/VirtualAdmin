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
            <div class="row justify-content-between mt-5 pt-4">
                <div class="col-4">
                    <form method="get" action="{{ route('backups.search') }}">
                        <div class="input-group">
                            <input name="search" type="search" id="form" class="form-control"/>
                            <button type="submit" class="btn btn-primary">
                                Buscar
                            </button>
                        </div>
                    </form>
                </div>
                <div class="pagination justify-content-end col-4">
                    {!! $backups->links('pagination::bootstrap-4') !!}
                </div>
            </div>
            <table class="table align-middle mb-0 mt-3 bg-white">
                <thead class="bg-light">
                <tr>
                    <th>Servidor</th>
                    <th>Dominios</th>
                    <th>Dominios fallidos</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Tamaño</th>
                    <th>Comenzó</th>
                    <th>Finalizó</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($backups as $backup)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">{{$backup->server}}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$backup->domains}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$backup->failed}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$backup->status}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$backup->type}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$backup->size}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$backup->started}}</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{$backup->ended}}</p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination mt-3 justify-content-end">
                {!! $backups->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </body>
</html>
