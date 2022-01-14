@extends('adminlte::page')

@section('plugins.Sweetalert2', true)

@section('title', 'Tipos')

@section('content_header')
    <h1>Cadastrar Tipos</h1>
@stop


@section('content')
    <form action="{{ route('types.store') }}" method="POST">
        @csrf

        @include('admin.types._partials.form')
    </form>
@endsection
