@extends('template')

@section('css', 'doctor.css')
@section('title', 'Usuários')

@section('sidebar')
    @parent
@stop

@section('content')
    <h6>Cadastro de Usuários</h6>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf

        <label>Nome:</label>
        <input type="text" name="name">

        <label>Email:</label>
        <input type="text" name="email">

        <label>Senha:</label>
        <input type="type" name="password">

        <input class="btn btn-primary" type="submit" value="Confirmar">
    </form>
@stop

@section('footer')
    @parent
@stop
