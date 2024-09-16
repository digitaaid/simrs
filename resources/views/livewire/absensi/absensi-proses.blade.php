<div class="row">
    <div class="col-md-6">
        <x-adminlte-card title="Absensi Hari Ini" theme="primary">
            Tanggal Shift : {{ now()->format('Y-m-d') }}<br>
            Nama Shhif : {{ $shift->nama_shift }}<br>
            Jadwal Shhif : {{ $shift->jam_masuk }}-{{ $shift->jam_pulang }}<br>
            Lokasi Saya : (<span class="latitude">0</span>, <span class="longitude">0</span>) <br>
            <script>
                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition, showError);
                    } else {
                        alert("Geolocation is not supported by this browser.");
                    }
                }

                function showPosition(position) {
                    $('.latitude').html(position.coords.latitude);
                    $('.longitude').html(position.coords.longitude);
                    $('#lat').val(position.coords.latitude);
                    $('#long').val(position.coords.longitude);
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
        </x-adminlte-card>
        @if ($shift->absensi_masuk)
            <x-adminlte-card title="Absensi Masuk" theme="primary">
                <div class="row">
                    <div class="col-md-6">
                        Absensi Masuk : {{ $shift->absensi_masuk }}<br>
                        Telat Masuk : {{ $shift->telat }}<br>
                        Lokasi Masuk : {{ $shift->lat_masuk }} , {{ $shift->long_masuk }}<br>
                        Jarak Masuk : {{ $shift->jarak_masuk }} m<br>
                    </div>
                    <div class="col-md-6">
                        Foto Masuk : {{ $shift->foto_absensi_masuk }}<br>
                        <img src="" alt="">
                    </div>
                </div>

            </x-adminlte-card>
        @endif
        @if ($shift->absensi_pulang)
            <x-adminlte-card title="Absensi Masuk" theme="primary">
                <div class="row">
                    <div class="col-md-6">
                        Absensi Pulang : {{ $shift->absensi_pulang }}<br>
                        Cepat Pulang : {{ $shift->pulang_cepat }}<br>
                        Lokasi Pulang : {{ $shift->lat_pulang }} , {{ $shift->long_pulang }}<br>
                        Jarak Pulang : {{ $shift->jarak_pulang }} m<br>
                    </div>
                    <div class="col-md-6">
                        Foto Pulang : {{ $shift->foto_absensi_pulang }}<br>
                        <img src="" alt="">
                    </div>
                </div>
            </x-adminlte-card>
        @endif
    </div>
    <div class="col-md-6">
        <x-adminlte-card title="Proses Absensi" theme="primary">
            @if ($shift)
                @if (!$shift->absensi_masuk)
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
                    <h2>Anda Tidak Memiliki Jadwal Hari Ini</h2>
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

</div>
