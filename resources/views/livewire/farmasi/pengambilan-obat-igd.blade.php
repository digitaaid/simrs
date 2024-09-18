<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    @if (isset($kunjungans))
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $kunjungans->where('taskid', 1)->count() }}" text="Sisa Antrian"
                        theme="warning" icon="fas fa-user-injured" />
                </div>
            </div>
        </div>
    @endif

    <div class="col-md-12">
        <div wire:poll.4000ms="refreshComponent">
            @if ($resepantri)
                <x-adminlte-alert theme="warning" title="Perhatian !" dismissable>
                    Terdapat antrian resep atas nama pasien {{ $resepantri->kode }} dengan nomor antrian
                    {{ $resepantri->kode }} tanggal {{ $resepantri->kode }} yang belum diproses
                </x-adminlte-alert>
            @endif
        </div>
        <x-adminlte-card title="Data Pemesanan Obat IGD" theme="secondary">
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input wire:model.change='tanggal' type="date" name="tanggal" igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='caritanggal' theme="primary" label="Pilih" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live='search' name="search"
                        placeholder="Pencarian Berdasarkan Nama / No RM" igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='caritanggal' theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>No RM</th>
                        <th>Pasien</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Unit</th>
                        <th>Dokter</th>
                        <th>PIC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reseps as $resep)
                        <tr>
                            <td>{{ $resep->kode }}</td>
                            <td>{{ $resep->norm }}</td>
                            <td>{{ $resep->nama }}</td>
                            <td>
                                @switch($resep->status)
                                    @case(1)
                                        <span class="badge badge-warning">{{ $resep->status }}. Order</span>
                                    @break

                                    @case(2)
                                        <span class="badge badge-primary">{{ $resep->status }}. Peracikan</span>
                                    @break

                                    @case(2)
                                        <span class="badge badge-success">{{ $resep->status }}. Selesai</span>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td>
                                @if ($resep->status == 1)
                                    <x-adminlte-button wire:click='terimaResep({{ $resep }})' class="btn-xs"
                                        label="Terima Resep" theme="success" icon="fas fa-user-nurse" />
                                @endif
                                @if ($resep->status == 2)
                                    <x-adminlte-button wire:click='edit({{ $resep }})' class="btn-xs"
                                        label="Edit" theme="warning" icon="fas fa-edit" />
                                    <x-adminlte-button wire:click='selesai({{ $resep }})' class="btn-xs"
                                        label="Selesai" theme="success" icon="fas fa-check" />
                                @endif
                            </td>
                            <td>{{ $resep->namaunit }}</td>
                            <td>{{ $resep->namadokter }}</td>
                            <td>{{ $resep->pic }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
    <audio id="myAudio" autoplay>
        <source src="{{ asset('rekaman/Airport_Bell.mp3') }}" type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
    @push('js')
        <script>
            document.addEventListener('livewire:init', () => {
                Livewire.on('play-audio', (event) => {
                    $('#myAudio').trigger('play');
                    console.log('Playing audio addEventListener');
                });
            });
        </script>
    @endpush
</div>
