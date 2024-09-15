<div class="row">
    <div class="col-md-6">
        <x-adminlte-card title="Absensi Hari Ini" theme="primary">
            Tanggal Shift : {{ now()->format('Y-m-d') }}<br>
            Nama Shhif : {{ $shift->nama_shift }}<br>
            Jadwal Shhif : {{ $shift->jam_masuk }}-{{ $shift->jam_pulang }}<br>
            Lokasi Saya : (<span class="latitude">0</span>, <span class="longitude">0</span>) <br>
            <button onclick="getLocation()">Get Lokasi</button>
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
                    alert(position.coords.latitude);
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
    </div>
    <div class="col-md-6">
        <x-adminlte-card title="Foto Absensi" theme="primary">
            <div class="webcam" id="results"></div>
        </x-adminlte-card>
    </div>
    <script type="text/javascript" src="{{ url('webcamjs/webcam.min.js') }}"></script>
    <script language="JavaScript">
        Webcam.set({
            width: 240,
            height: 320,
            image_format: 'jpeg',
            jpeg_quality: 50
        });
        Webcam.attach('.webcam');
    </script>
    <script language="JavaScript">
        function take_snapshot() {
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
