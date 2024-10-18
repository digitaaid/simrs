<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h1 class="h3 mb-2 text-gray-800">{{ $lat }}, {{ $long }}</h1> --}}
        </div>
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
                        initMap({{ $lat }}, {{ $long }}); // Misalnya menggunakan nilai default
                    });
                } else {
                    // Jika browser tidak mendukung geolocation
                    alert("Geolocation tidak didukung oleh browser ini.");
                    initMap({{ $lat }}, {{ $long }}); // Menggunakan nilai default
                }
            </script>
        </div>
    </div>
    <br><br>
</div>
