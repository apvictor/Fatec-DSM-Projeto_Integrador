{{-- @include('admin.includes.alerts') --}}

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="input-group mb-3">
                <span class="input-group-text" for="type">Tipo*</span>
                <input type="text" class="form-control" name="type" id="type"
                    value="{{ $type->type ?? old('type') }}">
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
