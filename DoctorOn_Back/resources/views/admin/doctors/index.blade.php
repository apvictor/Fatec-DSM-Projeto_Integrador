@extends('adminlte::page')

@section('title', 'Médicos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('doctors.index') }}" class="breadcrumb-item active">Médicos</a>
        </li>
    </ol>

    <div style="display: flex; justify-content: space-between;">
        <h1>Médicos</h1>
        <a href="{{ route('doctors.create') }}" class="btn btn-dark">Adicionar</a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            {{-- <form action="{{ route('categories.search') }}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtrar:" class="form-control"
                    value="{{ $filters['filter'] ?? '' }}">
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form> --}}
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Médico</th>
                        <th>CRM</th>
                        <th>Sexo</th>
                        <th>Especialidade</th>
                        <th width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctors as $doctor)
                        <tr>
                            <td><img src="{{ $doctor->doctor_img }}" width="30" height="30"></td>
                            <td>{{ $doctor->doctor }}</td>
                            <td>{{ $doctor->crm }}</td>
                            <td>{{ $doctor->sex }}</td>
                            <td>{{ $doctor->specialty }}</td>
                            <td>

                            </td>
                            <td style="width=30px;">
                                <div style="display: flex;">
                                    <a class="btn btn-{{ $doctor->active == 1 ? 'success' : 'dark' }}"
                                        href="{{ route('doctor.active', [$doctor->id, $doctor->active]) }}"
                                        title="{{ $doctor->active == 1 ? 'Desativar' : 'Ativar' }}">
                                        <i class="fas fa-user-nurse"></i>
                                    </a>
                                    <a style="margin: 0 5px;" href="{{ route('doctors.edit', $doctor->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form id="delete_from_{{ $doctor->id }}"
                                        action="{{ route('doctors.destroy', $doctor->id) }}" class="form"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button data-id="{{ $doctor->id }}" class="btn btn-danger delete_data">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {!! $doctors->links() !!}
        </div>
    </div>
@stop
