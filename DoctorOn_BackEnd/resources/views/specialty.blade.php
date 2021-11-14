@extends('template')

@section('css', 'specialty.css')
@section('title', 'Especialidade')

@section('sidebar')
    @parent
@stop

@section('content')

    <h6 class="title">Cadastro de Especialidade</h6>

    <form action="{{ route('specialty.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Especialidade:</label>
        <input type="text" name="specialty">
        <label>Selecione uma imagem:</label>
        <input type="file" name="img" accept=".img,.png,.jpg">
        <input class="btn btn-primary" type="submit" value="Confirmar">
    </form>

@stop

@section('footer')
    @parent
@stop
