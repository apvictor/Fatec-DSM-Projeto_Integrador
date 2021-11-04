@extends('template')

@section('css', 'contato.css')
@section('title', 'Contato')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="row">
        <div class="form">
            <h2 style="text-align: center">ENTRAR EM CONTATO</h2>
            <div class="col">
                <div class="input-group mb-3">
                    <span>Nome</span>
                    <input type="text" class="form-control" aria-label="Sizing example input"
                        aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group mb-3">
                    <span widht="20">Email</span>
                    <input type="email" class="form-control" placeholder="name@example.com"
                        aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                </div>
            </div>
            <div class="mb-3">
                <span widht="20">Mensagem</span>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"> </textarea>
            </div>

            <div class="btn">
                <button type="button" class="btn btn-secondary btn-lg btn-block">Enviar</button>
            </div>
        </div>
    </div>
@stop

@section('footer')
    @parent
@stop
