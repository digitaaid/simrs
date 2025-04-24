<div class="wrapper">
    <div class="row p-1">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-{{ config('adminlte.anjungan_color') }} text-white p-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <img src="{{ asset(config('adminlte.logo_img')) }}" width="80">
                                    <div class="col">
                                        <h2>Monitoring Rawat Inap</h2>
                                        <h4>{{ now()->translatedFormat('l, d F Y') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1>{{ config('adminlte.title') }}</h1>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="col-md-6" wire:poll.2s>
            <x-adminlte-card title="Monitoring Rawat Inap" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-procedures">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ruangan</th>
                            <th class="text-center">Kuota</th>
                            <th class="text-center">Tersedia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kamars as $item)
                            <tr>
                                <th>{{ $item->namaruang }}
                                    @if ($item->beds->where('status', 1)->count() == 0)
                                        <span class="badge badge-success">Kosong</span>
                                    @endif
                                    @if ($item->beds->where('status', 1)->count() < $item->beds->count() && $item->beds->where('status', 1)->count() > 0)
                                        <span class="badge badge-warning">Terisi</span>
                                    @endif
                                    @if ($item->beds->where('status', 1)->count() >= $item->beds->count())
                                        <span class="badge badge-danger">Penuh</span>
                                    @endif
                                </th>
                                <th class="text-center">{{ $item->beds->count() }}</th>
                                <th class="text-center">{{ $item->beds->where('status', 0)->count() }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>Total</th>
                            <th class="text-center">{{ $beds->count() }}</th>
                            <th class="text-center">{{ $beds->where('status', 0)->count() }}</th>
                        </tr>
                    </thead>
                </table>
                *Data terupdate {{ now() }}
            </x-adminlte-card>
        </div>
        <div class="col-md-4">
            <x-adminlte-card body-class="p-1 m-0">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" height="100%" width="100%"
                                src="{{ asset('bpjs/wajibmjkn.jpg') }}" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>...</h5>
                                <p>...</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" height="100%" width="100%"
                                src="{{ asset('bpjs/caramjkn.jpg') }}" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>...</h5>
                                <p>...</p>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
