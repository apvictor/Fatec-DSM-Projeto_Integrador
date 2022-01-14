@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Cadastrar Endereço da Unidade</h1>
@stop

@section('content')
    <form action="{{ route('address.store') }}" method="POST">
        @csrf
        <div class="container">
            <div class="row">

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="cep">CEP*</span>
                        <input type="text" class="form-control" name="cep" id="cep" value="{{ old('cep') }}">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="street">Rua*</span>
                        <input type="text" class="form-control" name="street" id="street" value="{{ old('street') }}">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="number">Número*</span>
                        <input type="text" class="form-control" name="number" id="number" value="{{ old('number') }}">
                    </div>
                </div>
            </div>
            
            <div class="row">

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="district">Bairro*</span>
                        <input type="text" class="form-control" name="district" id="district"
                            value="{{ old('district') }}">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="city">Cidade*</span>
                        <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
                    </div>
                </div>

                <div class="col-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" for="state">Estado*</span>
                        <input type="text" class="form-control" name="state" id="state" value="{{ old('state') }}">
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
