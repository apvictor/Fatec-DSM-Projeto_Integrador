@extends('template')

@section('css', 'index.css')
@section('title', 'Lista de Médicos')

@section('sidebar')
    @parent
@stop

@section('content')

    <h6 class="title">Lista de Médicos</h6>

    <div style="display: grid; justify-content: center; align-items: center;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Crm</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Saída</th>
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
                        <td style="display: flex;">
                            <button style="height: -webkit-fill-available;" class="btn btn-primary" data-toggle="modal"
                                data-target="#edit{{ $doctor->id }}">Alterar</button>
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

    {{-- MODAL --}}
    @foreach ($doctor_all as $doctor)
        <div class="modal fade" id="edit{{ $doctor->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel">Editar Médico</h4>
                        <button style="position: absolute;" type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('doctor.list.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Nome</label>
                                <input name="name" type="text" class="form-control" placeholder="Nome"
                                    value="{{ $doctor->name }}">
                            </div>
                            <div class="form-group">
                                <label>CRM</label>
                                <input name="crm" type="text" class="form-control" placeholder="CRM"
                                    value="{{ $doctor->crm }}">
                            </div>
                            <div class="form-group">
                                <label>Entrada</label>
                                <input name="start_time" type="time" class="form-control" placeholder="Entrada"
                                    value="{{ $doctor->start_time }}">
                            </div>
                            <div class="form-group">
                                <label>Saída</label>
                                <input name="end_time" type="time" class="form-control" placeholder="Saída"
                                    value="{{ $doctor->end_time }}">
                            </div>
                            <label>Imagem</label>
                            <div style="display: flex; align-items: center;" class="form-group">
                                <img src="{{ $doctor->img_doctor }}" id="img_url">
                                <input style="margin-left: 10px;" name="img_doctor" type="file" class="form-control"
                                    id="img_file" onChange="img_pathUrl(this);" value="{{ $doctor->img_doctor }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Alterar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            #img_url {
                background: #ddd;
                width: 40px;
                height: 40px;
                display: block;
                border-radius: 5px;
            }

        </style>

        <script>
            function img_pathUrl(input) {
                $('#img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
            }
        </script>
    @endforeach

@stop

@section('footer')
    @parent
@stop
