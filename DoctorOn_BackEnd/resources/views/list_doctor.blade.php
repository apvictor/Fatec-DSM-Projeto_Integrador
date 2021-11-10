@extends('template')

@section('css', 'index.css')
@section('title', 'Lista de Médicos')

@section('sidebar')
    @parent
@stop

@section('content')

    <h6>Lista de Médicos</h6>

    <div style="display: grid; justify-content: center; align-items: center;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Crm</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Saída</th>
                    <th scope="col">Especialidade</th>
                    <th scope="col">Ações</th>
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
                        <td style="display: flex;">
                            <form action="">
                                <button type="submit" class="btn btn-primary">Alterar</button>
                            </form>
                            <span style="margin: 2px"></span>
                            <form action="{{ route('doctor.list.destroy', $doctor->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
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
