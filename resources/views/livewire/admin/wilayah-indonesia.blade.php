<div class="row">
    <div class="col-md-6">
        <x-adminlte-card title="Wilayah Indonesia" theme="secondary" icon="fas fa-globe-asia">
            <x-adminlte-input wire:model.live="provinsi_id" list="provinsi_id_list" fgroup-class="row"
                label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="provinsi_id" label="Provinsi" />
            <datalist id="provinsi_id_list">
                @foreach ($provinsis as $code => $name)
                    <option value="{{ $name }}"></option>
                @endforeach
            </datalist>

            <x-adminlte-input wire:model.live="kabupaten_id" list="kabupaten_id_list" fgroup-class="row"
                label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="kabupaten_id"
                label="Kabupaten" />
            <datalist id="kabupaten_id_list">
                @foreach ($kabupatens as $code => $name)
                    <option value="{{ $name }}"></option>
                @endforeach
            </datalist>

            <x-adminlte-input wire:model.live="kecamatan_id" list="kecamatan_id_list" fgroup-class="row"
                label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="kecamatan_id"
                label="Kecamatan" />
            <datalist id="kecamatan_id_list">
                @foreach ($kecamatans as $code => $name)
                    <option value="{{ $name }}"></option>
                @endforeach
            </datalist>

            <x-adminlte-input wire:model.live="desa_id" list="desa_id_list" fgroup-class="row"
                label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="desa_id" label="Desa" />
            <datalist id="desa_id_list">
                @foreach ($desas as $code => $name)
                    <option value="{{ $name }}"></option>
                @endforeach
            </datalist>

            <!-- Display error message if search result is not found -->
            @if ($errorMessage)
                <div class="alert alert-danger mt-3">{{ $errorMessage }}</div>
            @endif
        </x-adminlte-card>
    </div>
</div>
