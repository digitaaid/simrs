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
        <div class="col-md-12">
            <x-adminlte-card class="m-2" title="Pilih Jadwal Dokter {{ $jenispasien }}" theme="green"
                icon="fas fa-user-md">
                <div class="row">
                    @foreach ($jadwals as $item)
                        @if ($item->libur)
                            <div class="col-md-4 ">
                                <x-adminlte-info-box title="{{ $item->namapoli }}" text="{{ $item->namadokter }}"
                                    description="{{ $item->jampraktek }}" theme="danger" class="m-1"
                                    icon-theme="dark" />
                            </div>
                        @else
                            <div class="col-md-4 ">
                                <x-adminlte-info-box wire:click='ambilantrian({{ $item->id }})'
                                    title="{{ $item->namapoli }}" text="{{ $item->namadokter }}"
                                    description="{{ $item->jampraktek }}" theme="success" class="m-1"
                                    icon-theme="dark" />
                            </div>
                        @endif
                    @endforeach
                </div>
                <x-slot name="footerSlot">
                    <a wire:navigate href="{{ route('anjunganantrian.index') }}">
                        <x-adminlte-button icon="fas fa-arrow-left" theme="danger" label="Kembali" />
                    </a>
                </x-slot>
            </x-adminlte-card>
        </div>
    </div>
</div>
