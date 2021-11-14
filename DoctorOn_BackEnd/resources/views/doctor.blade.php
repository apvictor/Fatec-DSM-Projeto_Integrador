@extends('template')

@section('css', 'doctor.css')
@section('title', 'Médicos')

@section('sidebar')
    @parent
@stop

@section('content')
    <h6 class="title">Cadastro de Médicos</h6>
    <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="name">Nome completo</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nome completo" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="crm">CRM</label>
                <input type="number" name="crm" class="form-control" id="crm" placeholder="CRM" required>
            </div>
            <div class="col-md-3 mb-5">
                <label for="especialidade">Especialidade</label>
                <select name="specialties_id" id="especialidade" class="form-control" required>
                    @foreach ($specialty as $specialties)
                        <option value="{{ $specialties->id }}">{{ $specialties->specialty }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-3 mb-3">
                <label for="start_time">Horário de Entrada</label>
                <input type="time" name="start_time" class="form-control" id="start_time" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="end_time">Horário de Saída</label>
                <input type="time" name="end_time" class="form-control" id="end_time" required>
            </div>

            <div class="col-md-3 mb-3">
                <label>Sexo:</label>
                <div>
                    <input class="form-check-input" name="sex" type="radio" id="f" value="F" checked>
                    <label class="form-check-label" for="f">
                        Feminino
                    </label>
                </div>
                <div>
                    <input class="form-check-input" name="sex" type="radio" id="m" value="M">
                    <label class="form-check-label" for="m">
                        Masculino
                    </label>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="custom-file">
                    <label>Foto médico</label>
                    <input name="img_doctor" type="file" accept=".img,.png,.jpg">
                </div>
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
