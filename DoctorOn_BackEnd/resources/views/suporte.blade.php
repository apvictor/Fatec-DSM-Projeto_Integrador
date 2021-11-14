@extends('template')

@section('css', 'suporte.css')
@section('title', 'Suporte')

@section('sidebar')
    @parent
@stop

@section('content')
    <div class="row">
        <div class="form">
            <h6 class="title">ENTRAR EM CONTATO</h6>
            <form action="{{ route('suporte.store') }}" method="POST">
                @csrf
                <div style="display: grid; align-items: center; justify-items: center;">
                    <div class="mb-3" style="width: 500px">
                        <label for="title">Título</label>
                        <input type="text" name="title" class="form-control" id="title" placeholder="Título" required>
                    </div>
                    <div class="mb-3" style="width: 500px">
                        <label for="msg">Mensagem</label>
                        <textarea name="msg" class="form-control" id="msg" rows="3" required></textarea>
                    </div>

                    <div class="mb-3" style="width: 300px">
                        <input class="btn btn-primary" type="submit" value="Confirmar">
                    </div>
                </div>


            </form>
        </div>
    </div>
    <hr>

    {{-- SEÇÃO DE RESPOSTAS --}}
    <h4 style="text-align: center">PERGUNTAS</h4>

    @foreach ($messages as $messages)
        <details>
            <summary>
                <span class="badge badge-dark">{{ $messages->id }} </span>
                Título: {{ $messages->title }} -
                <span class="badge badge-secondary">{{ $messages->created_at }}</span>
            </summary>
            <div style="background-color: beige; height: 10%;">
                <p style="padding: 10px">{{ $messages->msg }}</p>
            </div>
        </details>
    @endforeach

    {{-- SEÇÃO DE RESPOSTAS --}}
    <h4 style="text-align: center">PERGUNTAS RESPONDIDAS</h4>

    @foreach ($answers as $answer)
        <div style="background-color: beige; border-radius: 5px; margin-bottom: 50px; padding: 10px;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div style="padding: 10px">
                    <span style="padding: " class="badge badge-dark">{{ $answer->id }} </span>
                </div>

                <h3><b>{{ $answer->title }}</b></h3>
                <div style="padding: 10px">
                    <span style="text-align: end;" class="badge badge-secondary">{{ $answer->created_at }}</span>
                </div>
            </div>
            <div style="background-color: white; border-radius: 5px;">
                <div style="padding: 10px">
                    <span class="badge badge-dark">Enviado</span>
                </div>
                <p style="padding: 0 10px">{{ $answer->msg }}</p>
            </div>

            {{-- RESPOSTA --}}

            @if (isset($answers))
                <div style="background-color: white; border-radius: 5px;">
                    <div style="padding: 10px; text-align: end;">
                        <span class="badge badge-dark">Recebido</span>
                    </div>
                    <p style="padding: 0 10px; text-align: end;">{{ $answer->resp }}</p>
                </div>
            @endif
        </div>
    @endforeach


@stop

@section('footer')
    @parent
@stop
