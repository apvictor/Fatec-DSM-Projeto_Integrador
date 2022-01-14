@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastrar Unidade</h1>
@stop

@section('content')
    <form action="{{ route('unit.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="unit">Unidade*</span>
                        <input type="text" class="form-control" name="unit" id="unit" value="{{ old('unit') }}">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="cnpj">CNPJ*</span>
                        <input type="text" class="form-control" name="cnpj" id="cnpj" value="{{ old('cnpj') }}">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="phone">Telefone*</span>
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}">
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
