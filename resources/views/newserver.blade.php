@extends('layouts.newservertemplate')

@section('nav')
    @include('partials.nav')
@endsection

@section('method')"post"@endsection

@section('action')"{{ route('servers.store') }}"@endsection

@section('title')
    <h1 class="text-white mb-4">Añadir Servidor</h1>
@endsection

@section('url')""@endsection

@section('name')""@endsection
