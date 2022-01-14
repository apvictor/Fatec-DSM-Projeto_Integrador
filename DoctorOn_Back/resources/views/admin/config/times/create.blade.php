@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastrar Horários da Unidade</h1>
@stop

@section('content')
    <form action="{{ route('time.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="start_time">Horário de Entrada*</span>
                        <input type="time" class="form-control" name="start_time" id="start_time"
                            value="{{ old('start_time') }}">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="end_time">Horário de Saída*</span>
                        <input type="time" class="form-control" name="end_time" id="end_time"
                            value="{{ old('end_time') }}">
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-4">
                    <div class="input-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="always_available" class="form-check-input" id="always_available">
                            <label class="form-check-label" for="always_available">24 Horas</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-dark">Enviar</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
