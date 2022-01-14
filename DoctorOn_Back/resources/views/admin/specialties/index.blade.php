@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('specialties.index') }}"
                class="breadcrumb-item active">Especialidades</a></li>
    </ol>

    <div style="display: flex; justify-content: space-between;">
        <h1>Especialidades</h1>
        <a href="{{ route('specialties.create') }}" class="btn btn-dark">Adicionar</a>
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
                        <th>Especialidade</th>
                        <th width="150"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($specialties as $specialty)
                        <tr>
                            <td><img src="{{ $specialty->specialty_img }}" width="30" height="30"></td>
                            <td>{{ $specialty->specialty }}</td>
                            <td style="width=30px;">
                                <div style="display: flex;">
                                    <a style="margin: 0 5px;" href="{{ route('specialties.edit', $specialty->id) }}"
                                        class="btn btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form id="delete_from_{{ $specialty->id }}"
                                        action="{{ route('specialties.destroy', $specialty->id) }}" class="form"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button data-id="{{ $specialty->id }}" class="btn btn-danger delete_data">
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
            {!! $specialties->links() !!}
        </div>
    </div>

@stop
