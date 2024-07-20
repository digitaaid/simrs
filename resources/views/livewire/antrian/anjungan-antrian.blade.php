<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-green text-white p-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <img src="{{ asset('kitasehat/logokitasehat-lingkar.png') }}" width="80">
                                    <div class="col">
                                        <h2>Anjungan Antrian</h2>
                                        <h4>{{ env('APP_NAME_LONG') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1>{{ env('APP_NAME') }}</h1>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Pilih Jenis Pasien" theme="green" icon="fas fa-user-plus">
                <a wire:navigate href="{{ route('anjunganantrian.create', ['JKN', now()->format('Y-m-d')]) }}">
                    <x-adminlte-card class="mb-2 withLoad" body-class="bg-success">
                        <h1>PASIEN BPJS</h1>
                    </x-adminlte-card>
                </a>
                    <a wire:navigate href="{{ route('anjunganantrian.create', ['NON-JKN', now()->format('Y-m-d')]) }}">
                        <x-adminlte-card class="mb-2 withLoad" body-class="bg-success">
                            <h1>PASIEN UMUM</h1>
                        </x-adminlte-card>
                    </a>
            </x-adminlte-card>
            <x-adminlte-card title="Anjungan Checkin Antrian" theme="green" icon="fas fa-qrcode">
                <div class="text-center">
                    <x-adminlte-input name="kodebooking" label="Silahkan scan QR Code Antrian atau masukan Kode Antrian"
                        placeholder="Masukan Kode Antrian untuk Checkin">
                        <x-slot name="appendSlot">
                            <x-adminlte-button name="btn_checkin" id="btn_checkin" theme="success" label="Checkin!" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-success">
                                <i class="fas fa-qrcode"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <img src="{{ asset('qrcode-portal.png') }}" width="30%" alt="">
                    <br>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button icon="fas fa-sync" class="withLoad reload" theme="warning" label="Reload" />
                    <a href="{{ route('anjunganantrian.test') }}" class="btn btn-warning withLoad"><i
                            class="fas fa-print"></i>
                        Test
                        Printer</a>
                    <a href="{{ route('anjunganantrian.checkin') }}" class="btn btn-warning withLoad"><i
                            class="fas fa-print"></i> Checkin
                        Antrian</a>
                </x-slot>
            </x-adminlte-card>
        </div>
        <div class="col-md-6">
            <p hidden>{{ setlocale(LC_ALL, 'IND') }}</p>
            <x-adminlte-card title="Informasi Antrian {{ \Carbon\Carbon::now()->formatLocalized('%A, %d %B %Y') }}"
                theme="green" icon="fas fa-calendar-alt">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Poliklinik</th>
                                    <th>Dokter</th>
                                    <th>Jam Praktek</th>
                                    <th>Kuota</th>
                                    <th>Antrian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td>{{ $jadwal->namasubspesialis }}</td>
                                        <td>{{ $jadwal->namadokter }}</td>
                                        <td>{{ $jadwal->jampraktek }}</td>
                                        <td>{{ $jadwal->kapasitas }}</td>
                                        <td>
                                            {{ $jadwal->antrians->where('tanggalperiksa', now()->format('Y-m-d'))->where('taskid', '!=', 99)->count() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </x-adminlte-card>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-1">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ asset('medicio/assets/img/about.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="{{ asset('medicio/assets/img/slide/slide-2.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="{{ asset('medicio/assets/img/slide/slide-3.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="{{ asset('medicio/assets/img/slide/slide-1.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body p-1">
                            <div id="carouselExampleIndicators2" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="0" class="active">
                                    </li>
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators2" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ asset('medicio/assets/img/about.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="{{ asset('medicio/assets/img/slide/slide-2.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="{{ asset('medicio/assets/img/slide/slide-3.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100"
                                            src="{{ asset('medicio/assets/img/slide/slide-1.jpg') }}"
                                            alt="First slide">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>...</h5>
                                            <p>...</p>
                                        </div>
                                    </div>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators2" role="button"
                                    data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators2" role="button"
                                    data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
