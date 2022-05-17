@extends('layouts.users')

@section('route')"login"@endsection

@section('form')
    <div class="form-floating mb-3">
        <input name="name" type="username" required autofocus class="form-control" id="floatingInput" value="{{ old('name') }}" placeholder="Username">
        <label for="floatingInput">Usuario</label>
    </div>
    <div class="form-floating">
        <input name="password" type="password" required class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Contraseña</label>
    </div>
    <div class="mt-5">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Iniciar</button>
    </div>
@endsection
