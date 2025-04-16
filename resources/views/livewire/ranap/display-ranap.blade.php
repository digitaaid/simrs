<div class="wrapper">
    <div class="row p-1">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-{{ env('APP_COLOUR') }} text-white p-2">
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
            <x-adminlte-card title="Monitoring Rawat Inap" theme="{{ env('APP_COLOUR') }}" icon="fas fa-procedures">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Ruangan</th>
                            <th class="text-center">Kuota</th>
                            <th class="text-center">Tersedia</th>
                        </tr>
                    </thead>
                    <tbody wire:poll.2s>
                        @foreach ($kamars as $item)
                            <tr>
                                <th>{{ $item->namaruang }}
                                    @if ($item->beds->where('status', 1)->count() == 0)
                                        <span class="badge badge-success">Kosong</span>
                                    @endif
                                    @if ($item->beds->where('status', 1)->count() < $item->beds->count() && $item->beds->where('status', 1)->count() > 0)
                                        <span class="badge badge-warning">Terisi</span>
                                    @endif
                                    @if ($item->beds->where('status', 1)->count() >= $item->beds->count() )
                                    <span class="badge badge-danger">Penuh</span>
                                @endif
                                </th>
                                <th class="text-center">{{ $item->beds->count() }}</th>
                                <th class="text-center">{{ $item->beds->where('status', 0)->count() }}</th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-adminlte-card>
        </div>
        <div class="col-md-6">

        </div>
    </div>
</div>
