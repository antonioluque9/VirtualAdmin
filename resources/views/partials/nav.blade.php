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
                @if (Request::path() == ('domains'))
                    <a class="nav-link active" aria-current="page" href="/domains">Dominios</a>
                @else
                    <a class="nav-link" href="/domains">Dominios</a>
                @endif
            </li>
            <li class="nav-item">
                @if (Request::path() == ('backups'))
                    <a class="nav-link active" aria-current="page" href="/backups">Backups</a>
                @else
                    <a class="nav-link" href="/backups">Backups</a>
                @endif
            </li>
            <li class="nav-item">
                @if (Request::path() == ('newserver'))
                    <a class="nav-link active" aria-current="page" href="/newserver">Añadir Servidor</a>
                @else
                    <a class="nav-link" href="/newserver">Añadir Servidor</a>
                @endif
            </li>
        </ul>
    </div>
    <div class="me-2" id="navbarNav">
        <form method="post" action="/logout">
            <ul class="navbar-nav">
                <li class="nav-item">
                    @csrf
                    <a class="nav-link" href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a>
                </li>
            </ul>
        </form>
    </div>
</nav>
