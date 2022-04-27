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
