<div class="row">
    <div class="col-md-6">
        <x-adminlte-card title="Absensi Masuk" theme="primary">
            <div class="row">
                <div class="col-md-6">
                    <style>
                        .table-xs,
                        .table-xs td,
                        .table-xs th {
                            padding: 0px;
                            margin-bottom: 0px !important;
                            padding-right: 3px;
                        }
                    </style>
                    <table class="table table-borderless table-xs table-responsive">
                        <tr>
                            <td>Tanggal Absensi</td>
                            <td>:</td>
                            <th>{{ now()->format('Y-m-d') }}</th>
                        </tr>
                        <tr>
                            <td>Nama Jadwal</td>
                            <td>:</td>
                            <th>{{ $shift->nama_shift ?? 'Anda Tidak Memiliki Jadwal' }}</th>
                        </tr>
                        @if ($shift)
                            <tr>
                                <td>Jadwal Masuk</td>
                                <td>:</td>
                                <th>{{ $shift->jam_masuk }}</th>
                            </tr>
                            <tr>
                                <td>Jadwal Pulang</td>
                                <td>:</td>
                                <th>{{ $shift->jam_pulang }}</th>
                            </tr>
                            <tr>
                                <td>Abensi Masuk</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_masuk)
                                        {{ $shift->absensi_masuk }}
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <td>Telat Masuk</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_masuk)
                                        {{ floor($shift->telat / 3600) }} jam {{ floor($shift->telat % 3600) / 60 }}
                                        menit
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <td>Lokasi Masuk</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_masuk)
                                        {{ $shift->lat_masuk }} , {{ $shift->long_masuk }}
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <td>Jarak Masuk</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_masuk)
                                        {{ round($shift->jarak_masuk) }} meter
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="col-md-6">
                    Foto Masuk : {{ $shift->foto_absensi_masuk }}<br>
                    @if ($shift)
                        @if ($shift->foto_absensi_masuk)
                            <img width="100%" src="{{ url('storage/app/' . $shift->foto_absensi_masuk) }}"
                                alt="Foto Absensi Masuk">
                        @else
                            <span class="badge badge-danger">Belum Absensi Masuk</span>
                        @endif
                    @endif

                </div>
            </div>
        </x-adminlte-card>
    </div>
    <div class="col-md-6">
        <x-adminlte-card title="Absensi Pulang" theme="primary">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-borderless table-xs table-responsive">
                        <tr>
                            <td>Tanggal Absensi</td>
                            <td>:</td>
                            <th>{{ now()->format('Y-m-d') }}</th>
                        </tr>
                        <tr>
                            <td>Nama Jadwal</td>
                            <td>:</td>
                            <th>{{ $shift->nama_shift ?? 'Anda Tidak Memiliki Jadwal' }}</th>
                        </tr>
                        @if ($shift)
                            <tr>
                                <td>Jadwal Masuk</td>
                                <td>:</td>
                                <th>{{ $shift->jam_masuk }}</th>
                            </tr>
                            <tr>
                                <td>Jadwal Pulang</td>
                                <td>:</td>
                                <th>{{ $shift->jam_pulang }}</th>
                            </tr>
                            <tr>
                                <td>Abensi Pulang</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_pulang)
                                        {{ $shift->absensi_pulang }}
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <td>Pulang Cepat</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_pulang)
                                        {{ floor($shift->pulang_cepat / 3600) }} jam
                                        {{ floor($shift->pulang_cepat % 3600) / 60 }}
                                        menit
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <td>Lokasi Pulang</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_pulang)
                                        {{ $shift->lat_pulang }} , {{ $shift->long_pulang }}
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <td>Jarak Masuk</td>
                                <td>:</td>
                                <th>
                                    @if ($shift->absensi_pulang)
                                        {{ round($shift->jarak_pulang) }} meter
                                    @else
                                        <span class="badge badge-danger">Belum</span>
                                    @endif
                                </th>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="col-md-6">
                    Foto Pulang : {{ $shift->foto_absensi_pulang }}<br>
                    @if ($shift)
                        @if ($shift->foto_absensi_pulang)
                            <img width="100%" src="{{ url('storage/app/' . $shift->foto_absensi_pulang) }}"
                                alt="Foto Absensi Masuk">
                        @else
                            <span class="badge badge-danger">Belum Absensi Pulang</span>
                        @endif
                    @endif

                </div>
            </div>
        </x-adminlte-card>
    </div>
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
    <div class="col-md-12">
        <x-adminlte-card title="Proses Absensi" theme="primary">
            @if ($shift)
                @if ($shift->status_absen == null)
                    <form method="post" action="{{ route('absensi.masuk', $shift->id) }}">
                        @method('put')
                        @csrf
                        <center>
                            <h2>Absensi Masuk : </h2>
                            <h6>Lokasi Saat Ini : <span class="latitude">0</span>, <span class="longitude">0</span></h6>
                            <div id="map" style="width:100%;height:200px;"></div>
                            <div class="webcam" id="results" style="width:100%;"></div>
                            <input type="hidden" name="foto_absensi" class="image-tag">
                            <input type="hidden" name="lat_masuk" id="lat">
                            <input type="hidden" name="long_masuk" id="long">
                            <input type="hidden" name="telat">
                            <input type="hidden" name="jarak_masuk">
                            <input type="hidden" name="status_absen" value="Masuk">
                            <br>
                            <div onclick="getLocation()" class="btn btn-primary">Get Lokasi</div>
                            <button type="submit" class="btn btn-success" value="Ambil Foto"
                                onClick="take_snapshot()">Masuk</button>
                        </center>
                    </form>
                @else
                    <form method="post" action="{{ route('absensi.pulang', $shift->id) }}">
                        @method('put')
                        @csrf
                        <center>
                            <h2>Absensi Pulang : </h2>
                            <h6>Lokasi Saat Ini : <span class="latitude">0</span>, <span class="longitude">0</span></h6>
                            <div id="map" style="width:100%;height:200px;"></div>
                            <div class="webcam" id="results" style="width:100%;"></div>
                            <input type="hidden" name="foto_absensi" class="image-tag">
                            <input type="hidden" name="lat_pulang" id="lat">
                            <input type="hidden" name="long_pulang" id="long">
                            <input type="hidden" name="pulang_cepat">
                            <input type="hidden" name="jarak_pulang">
                            <input type="hidden" name="status_absen" value="Pulang">
                            <br>
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
