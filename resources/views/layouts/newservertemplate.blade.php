<!DOCTYPE html>
<html lang=es>
<head>
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="{{ asset('img/inno.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>VirtualAdmin</title>
<body>
@yield('nav')
<section class="vh-100" style="background-color: #2779e2;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <form method=@yield('method') action=@yield('action') >
                    @csrf
                    @yield('title')
                    @yield('id')
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body">
                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">URL</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="url" value=@yield('url') required autofocus name="url" class="form-control form-control-lg"/>
                                    <div class="small text-muted mt-2">Debes poner la ruta entera: http...</div>

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Nombre del Servidor</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" value=@yield('servername') required name="servername" class="form-control form-control-lg" />

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Usuario</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="text" value=@yield('username') required name="username" class="form-control form-control-lg" />

                                </div>
                            </div>

                            <hr class="mx-n3">

                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">

                                    <h6 class="mb-0">Contraseña</h6>

                                </div>
                                <div class="col-md-9 pe-5">

                                    <input type="password" required name="password" class="form-control form-control-lg" />

                                </div>
                            </div>

                            <hr class="mx-n3">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    @yield('buttom')
                                    <button type="submit" class="btn btn-primary btn-lg">Guardar</button>
                                </div>
                            </div>
                            @yield('errors')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

</body>
</html>
