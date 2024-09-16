<div class="row">
    {{-- The whole world belongs to you. --}}
    <div class="col-md-6">
        <x-adminlte-card title="Lokasi Absensi" theme="primary">
            <x-adminlte-input wire:model='latitude' name="latitude" fgroup-class="row" label-class="text-left col-4"
                igroup-class="col-8" igroup-size="sm" label="Latitude">
            </x-adminlte-input>
            <x-adminlte-input wire:model='longitude' name="longitude" fgroup-class="row" label-class="text-left col-4"
                igroup-class="col-8" igroup-size="sm" label="Longitude">
            </x-adminlte-input>
            <x-adminlte-input wire:model='radius' name="radius" fgroup-class="row" label-class="text-left col-4"
                igroup-class="col-8" igroup-size="sm" label="Radius">
            </x-adminlte-input>
            <x-slot name="footerSlot">
                <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan" wire:click="simpan"
                    wire:confirm='Apakah anda yakin akan menyimpan data lokasi absensi ?' />
                <x-adminlte-button theme="primary" icon="fas fa-map-marker-alt" class="btn-sm"
                    label="Ambil Lokasi Saat Ini" onclick="getLocation()" />
                <div wire:loading>
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                    </div>
                    Loading ...
                </div>
            </x-slot>
        </x-adminlte-card>
    </div>
    <div class="col-md-6">
        <x-adminlte-card title="Lokasi Saat Ini" theme="primary">
        </x-adminlte-card>
    </div>
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
</div>
