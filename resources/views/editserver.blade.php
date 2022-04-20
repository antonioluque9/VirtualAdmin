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

@section('name')"{{$server->name}}"@endsection

