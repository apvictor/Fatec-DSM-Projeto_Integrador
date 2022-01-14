{{-- @include('admin.includes.alerts') --}}

<div class="container">
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text" for="name">Nome*</span>
                <input type="text" class="form-control" name="name" id="name"
                    value="{{ $user->name ?? old('name') }}">
            </div>
        </div>

        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text" for="email">E-mail*</span>
                <input type="text" class="form-control" name="email" id="email"
                    value="{{ $user->email ?? old('email') }}">
            </div>
        </div>

        <div class="col">
            <div class="input-group mb-3">
                <span class="input-group-text" for="passowrd">Senha*</span>
                <input type="password" class="form-control" name="password" id="password"
                    value="{{ $user->password ?? old('password') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <div class="input-group mb-3">
                <span class="input-group-text" for="type">Tipo*</span>
                <select class="form-control" name="types_id" id="type">
                    <option selected value="{{ $user->types_id ?? old('type') }}">{{ $user->type ?? 'Selecione' }}
                    </option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id ?? old('type') }}">{{ $type->type }}</option>
                    @endforeach
                </select>
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
