@extends('layouts.users')

@section('route')"register"@endsection

@section('form')
    <div><p>Esta web solo tendrá un usuario</p></div>

    <div class="form-floating mb-3">
        <input name="name" type="username" required autofocus class="form-control" id="floatingInput" value="{{ old('name') }}" placeholder="Username">
        <label for="floatingInput">Usuario</label>
    </div>

    <div class="form-floating mb-3">
        <input name="email" type="email" required class="form-control" id="floatingInput" placeholder="Email">
        <label for="floatingInput">Email</label>
    </div>

    <div class="form-floating mb-3">
        <input name="password" type="password" required class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Contraseña</label>
    </div>

    <div class="form-floating mb-3">
        <input name="confirm-password" type="password" required class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Confirmar Contraseña</label>
    </div>

    <div class="mt-5">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Registrar</button>
    </div>
@endsection
