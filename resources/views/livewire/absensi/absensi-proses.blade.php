<div class="row">
    <div class="col-md-12">
        <x-adminlte-card title="Absensi Hari Ini" theme="primary">
            Tanggal Shift : <br>
            Jadwal Shhif : <br>
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
</div>
