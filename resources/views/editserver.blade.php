@extends('layouts.newservertemplate')

@section('method')"post"@endsection

@section('action')"{{ route('servers.update') }}"@endsection

@section('id')
    <input type="hidden" name="id" value="{{$server->id}}">
@endsection

@section('title')
    <h1 class="text-white mb-4">Editar Servidor</h1>
@endsection

@section('url')"{{$server->url}}"@endsection

@section('username')"{{$server->username}}"@endsection

@section('servername')"{{$server->servername}}"@endsection

@section('buttom')
    <button type="submit" class="mx-auto btn btn-danger btn-lg">
        <a class="text-decoration-none text-white" href="/servers">
            Cancelar
        </a>
    </button>
@endsection

@section('errors')
    <div class="mt-4">
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
