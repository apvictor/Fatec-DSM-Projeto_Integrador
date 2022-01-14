@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <h1>Cadastrar Usuários</h1>
@stop

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        @include('admin.users._partials.form')
    </form>
@endsection
