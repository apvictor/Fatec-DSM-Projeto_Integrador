{{-- @include('admin.includes.alerts') --}}

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="input-group mb-3">
                <span class="input-group-text" for="doctor">Nome*</span>
                <input type="text" class="form-control" name="doctor" id="doctor"
                    value="{{ $doctor->doctor ?? old('doctor') }}">
            </div>
        </div>

        <div class="col-4">
            <div class="input-group mb-3">
                <span class="input-group-text" for="crm">CRM*</span>
                @if ($doctor->crm ?? '')
                    <input type="text" class="form-control" name="crm" id="crm"
                        value="{{ $doctor->crm ?? old('crm') }}" disabled>
                @else
                    <input type="text" class="form-control" name="crm" id="crm"
                        value="{{ $doctor->crm ?? old('crm') }}">
                @endif
            </div>
        </div>

        <div class="col" style="margin: 0 20px;">
            <span class="input-text" for="doctor">Sexo*</span>
            <div class="form-check">
                <input class="form-check-input" value="F" {{ isset($doctor->sex) == 'F' ? 'checked' : '' }}
                    type="radio" name="sex" id="femi">
                <label class="form-check-label" for="femi">Feminino</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" value="M" {{ isset($doctor->sex) == 'M' ? 'checked' : '' }}
                    type="radio" name="sex" id="masc">
                <label class="form-check-label" for="masc">Masculino</label>
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom: 10px;">
        <div class="col-6">
            <div class="input-group">
                <span class="input-group-text" for="doctor_img">
                    <img id="img_url" src="{{ $doctor->doctor_img ?? old('doctor_img') }}" width="50" height="50">
                </span>
                <input type="file" name="doctor_img" class="form-control" id="doctor_img"
                    value="{{ $doctor->doctor_img ?? old('doctor_img') }}" onChange="img_pathUrl(this);">
            </div>
        </div>

        <div class="col-4">
            <div class="input-group mb-3">
                <span class="input-group-text" for="specialties_id">Especialidade*</span>
                <select class="form-control" name="specialties_id" id="specialties_id">
                    <option selected value="{{ $doctor->specialties_id ?? old('specialties_id') }}">
                        {{ $doctor->specialty ?? 'Selecione' }}
                    </option>
                    @foreach ($specialties as $specialty)
                        <option value="{{ $specialty->id ?? old('specialties_id') }}">
                            {{ $specialty->specialty }}
                        </option>
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
