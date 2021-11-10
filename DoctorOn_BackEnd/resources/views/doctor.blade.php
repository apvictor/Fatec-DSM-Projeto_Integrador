@extends('template')

@section('css', 'doctor.css')
@section('title', 'Médicos')

@section('sidebar')
    @parent
@stop

@section('content')
    <h6>Cadastro de Médicos</h6>
    <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Nome:</label>
        <input type="text" name="name" id="name">

        <label for="crm">CRM:</label>
        <input type="text" name="crm" id="crm">

        <label for="especialidade">Selecione a Especialidade:</label>
        <select name="specialties_id" id="especialidade">
            @foreach ($specialty as $specialties)
                <option value="{{ $specialties->id }}">{{ $specialties->specialty }}</option>
            @endforeach
        </select>

        <label>Sexo:</label>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sex" id="Masculino" value="M" checked>
            <label class="form-check-label">
                Masculino
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="sex" id="Feminino" value="F">
            <label class="form-check-label">
                Feminino
            </label>
        </div>

        <label>Imagem do Médico:</label>
        <input name="img_doctor" type="file" accept=".img,.png,.jpg">

        <div style="display: flex">
            <div style="margin-right: 20px;">
                <label>Horário de Entrada</label>
                <input style="width: 150px; text-align: center;" name="start_time" type="time" id="tempo">
            </div>

            <div>
                <label>Horário de Saída</label>
                <input style="width: 150px; text-align: center;" name="end_time" type="time" id="tempo">
            </div>
        </div>

        <input class="btn btn-primary" type="submit" value="Confirmar">
    </form>
@stop

@section('footer')
    @parent
@stop
