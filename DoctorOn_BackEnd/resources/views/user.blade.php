@extends('template')

@section('css', 'doctor.css')
@section('title', 'Usuários')

@section('sidebar')
    @parent
@stop

@section('content')
    <h6 class="title">Cadastro de Usuários</h6>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        
        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="name">Nome completo</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nome completo" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="email">E-mail</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="E-mail" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="senha">Senha</label>
                <input type="text" name="password" class="form-control" id="senha" placeholder="Senha" required>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-12 mb-3">
                <input class="btn btn-primary" type="submit" value="Confirmar">
            </div>
        </div>
    </form>
@stop

@section('footer')
    @parent
@stop
