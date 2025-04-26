<div class="wrapper">
    <div class="row p-1">
        <div class="col-md-12">
            <x-anjungan-header />
        </div>
        <div class="col-md-12">
            <x-adminlte-card class="m-2" title="Pilih Jadwal Dokter {{ $jenispasien }}"
                theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-user-md">
                <div class="row">
                    @foreach ($jadwals as $item)
                        @if ($item->libur)
                            <div class="col-md-4 ">
                                <x-adminlte-info-box title="{{ $item->namapoli }}" text="{{ $item->namadokter }}"
                                    description="{{ $item->jampraktek }}" theme="danger" class="m-1" />
                            </div>
                        @else
                            <div class="col-md-4 ">
                                <x-adminlte-info-box wire:click='ambilantrian({{ $item->id }})'
                                    title="{{ $item->namapoli }}" text="{{ $item->namadokter }}"
                                    description="{{ $item->jampraktek }}"
                                    theme="{{ config('adminlte.anjungan_color') }}" class="m-1" />
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
