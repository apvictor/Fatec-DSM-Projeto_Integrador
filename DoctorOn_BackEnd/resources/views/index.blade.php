@extends('template')

@section('css', 'index.css')
@section('title', 'Home')

@section('sidebar')
    @parent
@stop

@section('content')

    <div style="display: flex; align-items: center; justify-content: center;">
        <div class="card">
            <h3>{{ $doctor_active }}</h3>
            <h4>Médicos Ativos</h4>
        </div>
        <div class="card">
            <h3>{{ $doctor_count }}</h3>
            <h4>Médicos</h4>
        </div>
        <div class="card">
            <h3>{{ $users }}</h3>
            <h4>Usuários</h4>
        </div>
    </div>

    <div style="display: grid; justify-content: center; align-items: center;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nome</th>
                    <th scope="col">Crm</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Saída</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Ativo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctor_all as $doctor)
                    <tr>
                        <th scope="row"><img src="{{ $doctor->img_doctor }}" width="50" height="50"></th>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->crm }}</td>
                        <td>{{ $doctor->start_time }}</td>
                        <td>{{ $doctor->end_time }}</td>
                        <td>{{ $doctor->specialty }}</td>
                        <td>
                            @if ($doctor->active == 1)
                                <a style="text-decoration: none;"
                                    href="{{ route('doctor.active', [$doctor->id, $doctor->active]) }}">
                                    <button type="button" class="btn btn-dark">
                                        Desativar
                                    </button>

                                </a>
                            @else
                                <a style="text-decoration: none;"
                                    href="{{ route('doctor.active', [$doctor->id, $doctor->active]) }}">
                                    <button type="button" class="btn btn-dark">
                                        Ativar
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: center">
            {!! $doctor_all->links() !!}
        </div>
    </div>
@stop

@section('footer')
    @parent
@stop
