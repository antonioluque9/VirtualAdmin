<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="collapse navbar-collapse ms-2" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                @if (Request::path() == ('servers'))
                    <a class="nav-link active" aria-current="page" href="/servers">Servidores</a>
                @else
                    <a class="nav-link" href="/servers">Servidores</a>
                @endif
            </li>
            <li class="nav-item">
                @if (Request::path() == ('virtualhosts'))
                    <a class="nav-link active" aria-current="page" href="/virtualhosts">VirtualHosts</a>
                @else
                    <a class="nav-link" href="/virtualhosts">VirtualHosts</a>
                @endif
            </li>
            <li class="nav-item">
                @if (Request::path() == ('backups') || Request::path() == ('backups/search'))
                    <a class="nav-link active" aria-current="page" href="/backups">Backups</a>
                @else
                    <a class="nav-link" href="/backups">Backups</a>
                @endif
            </li>
            <li class="nav-item">
                @if (Request::path() == ('newserver/create'))
                    <a class="nav-link active" aria-current="page" href="/newserver/create">Añadir Servidor</a>
                @else
                    <a class="nav-link" href="/newserver/create">Añadir Servidor</a>
                @endif
            </li>
        </ul>
    </div>
    <div class="me-2" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropstart">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                    <i class="bi bi-person-fill" style="font-size: 20px"></i>
                </button>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start" aria-labelledby="navbarDropdown">
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#gmail">Cambiar Correo</button>
                        </li>
                        <li>
                            <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#passwd">Cambiar Contraseña</button>
                        </li>
                        <li>
                            <form method="get" action="/logout">
                                @csrf
                                <a class="dropdown-item" href="/logout" onclick="return confirm('Seguro que deseas salir')">Cerrar Sesión</a>
                            </form>
                        </li>
                    </ul>
            </li>
        </ul>
    </div>
</nav>

{{--Modal de cambio de correo--}}
<div class="modal fade" id="gmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Correo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" action="/changemail">
                    @csrf
                    <input type="email" name="mail" required autofocus class="m-2 mb-3 form-control"/>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{--Modal de cambio de contraseña--}}
<div class="modal fade" id="passwd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cambiar Correo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="get" action="/changepasswd">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="currentpassword" type="password" required class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Contraseña actual</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="newpassword" type="password" required class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Nueva Contraseña</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="confirm-newpassword" type="password" required class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Repetir Nueva Contraseña</label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

