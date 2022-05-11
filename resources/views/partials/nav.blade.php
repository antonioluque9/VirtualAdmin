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
            <li class="nav-item">
                <form method="post" action="/logout">
                    @csrf
                    <a class="nav-link" href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a>
                </form>
            </li>
{{--            <li class="nav-item mt-2">--}}
{{--                <label>Selecciona modo: </label>--}}
{{--                <select class="nav-item">--}}
{{--                    <option>Administrador</option>--}}
{{--                    <option onclick="">Lector</option>--}}
{{--                </select>--}}
{{--            </li>--}}
        </ul>
    </div>
</nav>
