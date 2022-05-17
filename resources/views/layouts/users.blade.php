<!DOCTYPE html><!--Con esta etiqueta seleccionamos el tipo de documento, en este caso html-->
<html lang=es><!--Aqui comienza el documento html-->
<head> <!--En el header he puesto el los contenidos basicos que toda pagina debe tener, tales como el UTF-8 para establecer la forma de codificacion, el nombre del autor, una descripcion de la pagina y las palabras clave para buscarla, ademas del favicon-->
    <meta charset="utf-8"/>
    <link rel="shortcut icon" href="{{ asset('img/inno.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>VirtualAdmin</title>
</head>
<body>
<section class="vh-100" style="background-color: #508bfc;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <h3 class="mb-5">VirtialAdmin</h3>
                        <form method="POST" action=@yield('route')>
                            @csrf
                            @yield('form')
                        </form>
                        <div class="mt-4">
                            @if($errors->any())
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
