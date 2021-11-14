@extends('template')

@section('css', 'index.css')
@section('title', 'Lista de Usuários')

@section('sidebar')
    @parent
@stop

@section('content')

    <h6 class="title">Lista de Mensagens</h6>

    <div style="display: grid; justify-content: center; align-items: center;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Mensagem</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($messages as $message)
                    <tr>
                        <td>{{ $message->id }}</td>
                        <td>{{ $message->title }}</td>
                        <td>{{ $message->msg }}</td>
                        <td style="display: flex;">
                            <button style="height: -webkit-fill-available;" class="btn btn-primary" data-toggle="modal"
                                data-target="#show{{ $message->id }}">Ver</button>
                            <span style="margin: 2px"></span>
                            <button style="height: -webkit-fill-available;" class="btn btn-success" data-toggle="modal"
                                data-target="#save{{ $message->id }}">Responder</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: center">
            {!! $messages->links() !!}
        </div>
    </div>

    {{-- MODAL VER --}}
    @foreach ($messages as $message)
        <div class="modal fade" id="show{{ $message->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Detalhes da Mensagem</h4>
                        <button style="position: absolute;" type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Título</label>
                            <input disabled name="name" type="text" class="form-control" placeholder="Nome"
                                value="{{ $message->title }}">
                        </div>
                        <div class="form-group">
                            <label>Mensagem</label>
                            <textarea disabled class="form-control" cols="30" rows="10">{{ $message->msg }}
                                                                                                    </textarea>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- MODAL RESPONDER --}}
    @foreach ($messages as $message)
        <div class="modal fade" id="save{{ $message->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Responder Mensagem</h4>
                        <button style="position: absolute;" type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('answers.store') }}" method="POST">
                            @csrf

                            <input type="hidden" name="msg_id" value="{{ $message->id }}">
                            <div class="form-group">
                                <label>Mensagem</label>
                                <textarea name="resp" class="form-control" cols="30" rows="10"></textarea>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



@stop

@section('footer')
    @parent
@stop
