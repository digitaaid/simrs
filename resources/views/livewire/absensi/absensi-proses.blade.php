<div class="row">
    <div class="col-md-6">
        <x-adminlte-card title="Absensi Hari Ini" theme="primary">
            <div class="row">
                <div class="col-md-6">
                    Tanggal Shift : {{ now()->format('Y-m-d') }}<br>
                    Lokasi Saya : (<span class="latitude">0</span>, <span class="longitude">0</span>) <br>
                    @if ($shift)
                        Nama Shhif : {{ $shift->nama_shift ?? 'Anda Tidak Memiliki Jadwal' }}<br>
                        Jadwal Shhif : {{ $shift->jam_masuk }}-{{ $shift->jam_pulang }}<br>
                    @else
                        <h4>Anda Tidak Memiliki Jadwal Hari Ini</h4>
                    @endif
                </div>
                <div class="col-md-6">
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
                            var circle = L.circle([{{ $lat_kantor }}, {{ $long_kantor }}], {
                                color: 'red',
                                fillColor: '#f03',
                                fillOpacity: 0.5,
                                radius: {{ $rad_kantor }}
                            }).addTo(map);
                            circle.bindPopup("<b>Radius Absensi</b>");
                        }

                        // Cek apakah geolocation tersedia
                        if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(function(position) {
                                var lat = position.coords.latitude;
                                var long = position.coords.longitude;
                                // Inisialisasi peta dengan latitude dan longitude yang didapat
                            }, function() {
                                // Jika pengguna menolak izin geolocation
                                alert("Geolocation tidak diizinkan. Silakan masukkan latitude dan longitude secara manual.");
                                // Anda bisa menginisialisasi dengan nilai default atau meminta pengguna memasukkan lokasi
                                initMap('{{ $lat_kantor }}', '{{ $long_kantor }}'); // Misalnya menggunakan nilai default
                            });
                        } else {
                            // Jika browser tidak mendukung geolocation
                            alert("Geolocation tidak didukung oleh browser ini.");
                            initMap("{{ $lat_kantor }}", "{{ $long_kantor }}"); // Menggunakan nilai default
                        }
                    </script>
                    <script>
                        function getLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition, showError);
                            } else {
                                alert("Geolocation is not supported by this browser.");
                            }
                        }

                        function showPosition(position) {
                            var lat = position.coords.latitude;
                            var long = position.coords.longitude;
                            $('.latitude').html(position.coords.latitude);
                            $('.longitude').html(position.coords.longitude);
                            $('#lat').val(position.coords.latitude);
                            $('#long').val(position.coords.longitude);
                            console.log(lat, long);
                            initMap(lat, long);
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
            </div>
        </x-adminlte-card>
        @if ($shift)
            @if ($shift->absensi_masuk)
                <x-adminlte-card title="Absensi Masuk" theme="primary">
                    <div class="row">
                        <div class="col-md-6">
                            Absensi Masuk : {{ $shift->absensi_masuk }}<br>
                            Telat Masuk : {{ floor($shift->telat / 3600) }} jam {{ floor($shift->telat % 3600) / 60 }}
                            menit<br>
                            Lokasi Masuk : {{ $shift->lat_masuk }} , {{ $shift->long_masuk }}<br>
                            Jarak Masuk : {{ round($shift->jarak_masuk) }} meter<br>
                        </div>
                        <div class="col-md-6">
                            Foto Masuk : {{ $shift->foto_absensi_masuk }}<br>
                            <img width="100%" src="{{ url('storage/app/' . $shift->foto_absensi_masuk) }}"
                                alt="Foto Absensi Masuk">
                        </div>
                    </div>
                </x-adminlte-card>
            @endif
            @if ($shift->absensi_pulang)
                <x-adminlte-card title="Absensi Pulang" theme="primary">
                    <div class="row">
                        <div class="col-md-6">
                            Absensi Pulang : {{ $shift->absensi_pulang }}<br>
                            Cepat Pulang : {{ floor($shift->pulang_cepat / 3600) }} jam
                            {{ floor($shift->pulang_cepat % 3600) / 60 }}
                            menit<br>
                            Lokasi Pulang : {{ $shift->lat_pulang }} , {{ $shift->long_pulang }}<br>
                            Jarak Pulang : {{ round($shift->jarak_pulang) }} meter<br>
                        </div>
                        <div class="col-md-6">
                            Foto Pulang : {{ $shift->foto_absensi_pulang }}<br>
                            <img width="100%" src="{{ url('storage/app/' . $shift->foto_absensi_pulang) }}"
                                alt="Foto Absensi Pulang">
                        </div>
                    </div>
                </x-adminlte-card>
            @endif
        @endif
    </div>
    <div class="col-md-6">
        <x-adminlte-card title="Proses Absensi" theme="primary">
            @if ($shift)
                @if ($shift->status_absen == null)
                    <form method="post" action="{{ route('absensi.masuk', $shift->id) }}">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="col"></div>
                            <div class="col">
                                <center>
                                    <h2>Absensi Masuk : </h2>
                                    <h6>Lokasi Saat Ini : <span class="latitude">0</span>, <span
                                            class="longitude">0</span></h6>
                                    <div id="map" style="width:100%;height:200px;"></div>
                                    <div class="webcam" id="results"></div>
                                </center>
                            </div>
                            <div class="col">
                                <input type="hidden" name="foto_absensi" class="image-tag">
                                <input type="hidden" name="lat_masuk" id="lat">
                                <input type="hidden" name="long_masuk" id="long">
                                <input type="hidden" name="telat">
                                <input type="hidden" name="jarak_masuk">
                                <input type="hidden" name="status_absen" value="Masuk">
                            </div>
                        </div>
                        <br>
                        <center>
                            <div onclick="getLocation()" class="btn btn-primary">Get Lokasi</div>

                            <button type="submit" class="btn btn-success" value="Ambil Foto"
                                onClick="take_snapshot()">Masuk</button>
                        </center>
                    </form>
                @else
                    <form method="post" action="{{ route('absensi.pulang', $shift->id) }}">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="col"></div>
                            <div class="col">
                                <center>
                                    <h2>Absensi Pulang : </h2>
                                    <h6>Lokasi Saat Ini : <span class="latitude">0</span>, <span
                                            class="longitude">0</span></h6>
                                    <div id="map" style="width:100%;height:200px;"></div>
                                    <div class="webcam" id="results"></div>
                                </center>
                            </div>
                            <div class="col">
                                <input type="hidden" name="foto_absensi" class="image-tag">
                                <input type="hidden" name="lat_pulang" id="lat">
                                <input type="hidden" name="long_pulang" id="long">
                                <input type="hidden" name="pulang_cepat">
                                <input type="hidden" name="jarak_pulang">
                                <input type="hidden" name="status_absen" value="Pulang">
                            </div>
                        </div>
                        <br>
                        <center>
                            <div onclick="getLocation()" class="btn btn-primary">Get Lokasi</div>

                            <button type="submit" class="btn btn-danger" value="Ambil Foto"
                                onClick="take_snapshot()">Pulang</button>
                        </center>
                    </form>
                @endif
            @else
                <center>
                    <h4>Anda Tidak Memiliki Jadwal Hari Ini</h4>
                    <div id="map" style="width:100%;height:200px;"></div>
                    <div class="webcam" id="results"></div>
                    <div onclick="getLocation()" class="btn btn-primary">Get Lokasi</div>
                </center>
            @endif

        </x-adminlte-card>
    </div>
    <script type="text/javascript" src="{{ asset('webcamjs/webcam.min.js') }}"></script>
    <script language="JavaScript">
        Webcam.set({
            width: 400,
            height: 400,
            image_format: 'jpeg',
            jpeg_quality: 50
        });
        Webcam.attach('.webcam');
    </script>
    <script language="JavaScript">
        function take_snapshot() {
            getLocation();
            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                // display results in page
                document.getElementById('results').innerHTML =
                    '<img src="' + data_uri + '"/>';
            });
        }
    </script>
    @section('js')
        <script>
            $(function() {});
        </script>
    @endsection
</div>
