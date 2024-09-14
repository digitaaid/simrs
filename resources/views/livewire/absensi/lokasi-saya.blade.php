<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <h1 class="h3 mb-2 text-gray-800">{{ $lat }}, {{ $long }}</h1> --}}
        </div>
        <div class="card-body">
            <div id="map" style="width:100%;height:600px;"></div>
            <script>
                var map = L.map('map').setView([{{ $lat }}, {{ $long }}], 18);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(map);
                var marker = L.marker([{{ $lat }}, {{ $long }}]).addTo(map);
                marker.bindPopup("<b>Lokasi Saya</b>").openPopup();

            </script>

        </div>
    </div>
    <br><br>
</div>
