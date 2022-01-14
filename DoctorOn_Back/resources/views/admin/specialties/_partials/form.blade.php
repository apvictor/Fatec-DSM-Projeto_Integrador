{{-- @include('admin.includes.alerts') --}}

<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="input-group mb-3">
                <span class="input-group-text" for="specialty">Especialidade*</span>
                <input type="text" class="form-control" name="specialty" id="specialty"
                    value="{{ $specialty->specialty ?? old('specialty') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="input-group mb-3">
                <span class="input-group-text" for="specialty_img">
                    <img id="img_url" src="{{ $specialty->specialty_img ?? old('specialty_img') }}" width="50"
                        height="50">
                </span>
                <input type="file" name="specialty_img" class="form-control" id="specialty_img"
                    value="{{ $specialty->specialty_img ?? old('specialty_img') }}" onChange="img_pathUrl(this);">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <div class="form-group">
                <button type="submit" class="btn btn-dark">Enviar</button>
            </div>
        </div>
    </div>
</div>
