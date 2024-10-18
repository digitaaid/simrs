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
            <div class="card-body">
                <div id="map" style="width:100%;height:600px;"></div>
                <script>
                    // Fungsi untuk menginisialisasi peta
                    function initMap(lat, long) {
                        var map = L.map('map').setView([lat, long], 18);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);
                        var marker = L.marker([lat, long]).addTo(map);
                        marker.bindPopup("<b>Lokasi Saya</b>").openPopup();
                        var circle = L.circle([{{ $latitude }}, {{ $longitude }}], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: {{ $radius }}
                        }).addTo(map);
                        circle.bindPopup("<b>Radius Absensi</b>");
                    }

                    // Cek apakah geolocation tersedia
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var lat = position.coords.latitude;
                            var long = position.coords.longitude;

                            // Inisialisasi peta dengan latitude dan longitude yang didapat
                            initMap(lat, long);
                        }, function() {
                            // Jika pengguna menolak izin geolocation
                            alert("Geolocation tidak diizinkan. Silakan masukkan latitude dan longitude secara manual.");
                            // Anda bisa menginisialisasi dengan nilai default atau meminta pengguna memasukkan lokasi
                            initMap(0, 0); // Misalnya menggunakan nilai default
                        });
                    } else {
                        // Jika browser tidak mendukung geolocation
                        alert("Geolocation tidak didukung oleh browser ini.");
                        initMap(0, 0); // Menggunakan nilai default
                    }
                </script>
            </div>
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
