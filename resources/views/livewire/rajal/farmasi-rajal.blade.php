<div class="row">
    <x-flash-message />
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $resepobats->where('status', 1)->count() }}" text="Resep Belum"
                    theme="warning" icon="fas fa-file-prescription" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $resepobats->where('status', 2)->count() }}" text="Resep Proses"
                    theme="primary" icon="fas fa-file-prescription" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box title="{{ $resepobats->where('status', 3)->count() }}" text="Resep Sudah"
                    theme="success" icon="fas fa-file-prescription" />
            </div>
        </div>
    </div>
    <div id="editresep" class="col-md-12">
        @if ($formEdit)
            <x-modal size="xl" title="Resep Obat {{ $resepEdit->nama }}" icon="fas fa-file-import" theme="dark">
                <x-flash-message />
                <div class="row">
                    <div class="col-md-4">
                        <h6>Identitas Pasien Obat Dokter</h6>
                        <table>
                            <tr>
                                <td>No RM</td>
                                <td>:</td>
                                <td>{{ $resepEdit->norm }}</td>
                            </tr>
                            <tr>
                                <td>Nama Pasien</td>
                                <td>:</td>
                                <td>
                                    <b>{{ $resepEdit->nama }}</b>
                                </td>
                            </tr>
                            <tr>
                                <td>Nama Dokter</td>
                                <td>:</td>
                                <td>{{ $resepEdit->namadokter }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <hr>
                        <h6>Resep Obat Dokter</h6>
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Obat</th>
                                    <th>Dosis</th>
                                    <th>Cara Pakai</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resepObatDokter as $obat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $obat['nama'] }}</td>
                                        <td>{{ $obat['frekuensi'] }}</td>
                                        <td>{{ $obat['waktu'] }}</td>
                                        <td>{{ $obat['jumlah'] }}</td>
                                        <td>{{ $obat['keterangan'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <h6>Resep Obat Farmasi</h6>
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <x-adminlte-button theme="success" icon="fas fa-plus" class="btn-xs"
                                            title="Tambah obat" wire:click="tambah" />
                                    </th>
                                    <th>Nama Obat</th>
                                    <th>Dosis</th>
                                    <th>Cara Pakai</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resepObat as $index => $obatfarmasi)
                                    <tr>
                                        <td>
                                            <x-adminlte-button theme="danger" icon="fas fa-times" class="btn-xs"
                                                title="Hapus obat" wire:click="hapus({{ $index }})" />
                                        </td>
                                        <td>
                                            <x-adminlte-input name="nama"
                                                wire:model="resepObat.{{ $index }}.nama"
                                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                                placeholder="Cari Nama Obat"
                                                wire:keyup.debounce.300ms="cariObat({{ $index }})"
                                                wire:click="cariObat({{ $index }})" />
                                            @if (!empty($searchingObat[$index]) && !empty($obats))
                                                <x-search-table :isSearching="$searchingObat[$index]" :data="$obats" :columns="['ID', 'Nam Obat', 'Satuan', 'Merk', 'Harga']"
                                                    clickEvent="pilihObat" />
                                            @endif
                                            @error('resepObat.' . $index . '.obat')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <x-adminlte-input name="frekuensi"
                                                wire:model="resepObat.{{ $index }}.frekuensi"
                                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                                placeholder="Masukan Dosis"
                                                wire:keyup.debounce.300ms="cariFrekuensi({{ $index }})"
                                                wire:click="cariFrekuensi({{ $index }})" />
                                            @if (!empty($searchingFrekuensi[$index]) && !empty($frekuensis))
                                                <x-search-table :isSearching="$searchingFrekuensi[$index]" :data="$frekuensis" :columns="['Dosis']"
                                                    clickEvent="pilihFrekuensi" />
                                            @endif
                                        </td>
                                        <td>
                                            <x-adminlte-input name="waktu"
                                                wire:model="resepObat.{{ $index }}.waktu"
                                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                                placeholder="Masukan Cara Pakai"
                                                wire:keyup.debounce.300ms="cariWaktu({{ $index }})"
                                                wire:click="cariWaktu({{ $index }})" />
                                            @if (!empty($searchingWaktu[$index]) && !empty($waktus))
                                                <x-search-table :isSearching="$searchingWaktu[$index]" :data="$waktus" :columns="['Cara Pakai']"
                                                    clickEvent="pilihWaktu" />
                                            @endif
                                        </td>
                                        <td>
                                            <x-adminlte-input wire:model="resepObat.{{ $index }}.harga"
                                                name="harga" igroup-class="input-group-xs"
                                                fgroup-class="form-group-xs" placeholder="Harga" />
                                            @error('resepObat.' . $index . '.harga')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <x-adminlte-input wire:model="resepObat.{{ $index }}.jumlah"
                                                name="jumlah" igroup-class="input-group-xs"
                                                fgroup-class="form-group-xs" type="number" placeholder="Jumlah Obat" />
                                            @error('resepObat.' . $index . '.jumlah')
                                                <span class="invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <x-adminlte-input wire:model="resepObat.{{ $index }}.keterangan"
                                                name="keterangan" igroup-class="input-group-xs"
                                                fgroup-class="form-group-xs" placeholder="Keterangan" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-slot name="footerSlot">
                    <x-adminlte-button wire:confirm='Apakah anda yakin akan menyimpan resep obat terbaru ini ?'
                        wire:click='simpan' class="btn-sm" label="Simpan" theme="success" icon="fas fa-save" />
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-modal>
        @endif
    </div>
    <div class="col-md-12">
        <div wire:poll.4000ms="refreshComponent">
            @if ($antrianresep)
                <x-adminlte-alert theme="warning" title="Perhatian !" dismissable>
                    Terdapat resep obat atas nama pasien {{ $antrianresep->nama }} belum diproses oleh
                    {{ $antrianresep->pic }} oleh {{ $antrianresep->waktu }} yang belum diproses
                </x-adminlte-alert>
            @endif
        </div>
        <x-adminlte-card title="Data Resep Obat" theme="secondary" icon="fas fa-file-prescription">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-input wire:model.change='tanggalperiksa' type="date" name="tanggalperiksa"
                        igroup-size="sm">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-5">
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
            @php
                $heads = [
                    'No',
                    'Antrian',
                    'No RM',
                    'Nama Pasien',
                    'Jaminan',
                    'Action',
                    'Etiket+Resep',
                    'Invoice',
                    'Unit',
                    'PIC',
                    'Waktu',
                    'Rp.Layanan',
                    'Rp.Obat',
                ];
                $config['order'] = [5, 'asc'];
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="text-nowrap" :heads="$heads" :config="$config" bordered
                hoverable compressed>
                @foreach ($resepobats as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode }}</td>
                        <td>{{ $item->norm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->kunjungan->jaminans->nama }}</td>
                        <td>
                            @if ($item->status == 1)
                                <x-adminlte-button wire:click="terima('{{ $item->kode }}')" class="btn-xs"
                                    label="Terima Resep" theme="success" icon="fas fa-file-prescription" />
                            @endif
                            @if ($item->status == 2)
                                <x-adminlte-button wire:click="edit('{{ $item->kode }}')" class="btn-xs"
                                    theme="warning" icon="fas fa-edit" title="Edit Resep Obat" />
                                <x-adminlte-button wire:confirm='Apakah anda yakin pasien telah mendapatkan obat ?'
                                    wire:click="selesai('{{ $item->kode }}')" class="btn-xs" title="Selesai"
                                    theme="success" icon="fas fa-check" />
                            @endif
                            @if ($item->status == 3)
                                <x-adminlte-button wire:click="edit('{{ $item->kode }}')" class="btn-xs"
                                    theme="warning" icon="fas fa-edit" title="Edit Resep Obat" />
                                <x-adminlte-button wire:confirm='Apakah anda yakin panggil ulang pasien ?'
                                    wire:click="panggilfarmasi('{{ $item->kode }}')" class="btn-xs"
                                    title="Panggil" theme="primary" icon="fas fa-check" />
                            @endif
                        </td>
                        <td>
                            <a target="_blank" href="{{ route('print.etiket') }}?kode={{ $item->kode }}">
                                <x-adminlte-button class="btn-xs" theme="success" icon="fas fa-print"
                                    title="Print Etiket Dokter" label="E" />
                            </a>
                            <a href="{{ route('print.resep', $item->kode) }}" target="_blank">
                                <x-adminlte-button class="btn-xs" label="D" title="Print Resep Obat Dokter"
                                    theme="primary" icon="fas fa-file-prescription" />
                            </a>
                            <a href="{{ route('print.resepfarmasi', $item->kode) }}" target="_blank">
                                <x-adminlte-button class="btn-xs" label="F" title="Print Resep Obat Farmasi"
                                    theme="primary" icon="fas fa-file-prescription" />
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('print.notarajal', $item->kodebooking) }}" target="_blank">
                                <x-adminlte-button class="btn-xs" label="D"
                                    title="Print Invoice Resep Obat Dokter" theme="warning"
                                    icon="fas fa-file-invoice-dollar" />
                            </a>
                            <a href="{{ route('print.notarajalf', $item->kodebooking) }}" target="_blank">
                                <x-adminlte-button class="btn-xs" label="F"
                                    title="Print Invoice Resep Obat Farmasi" theme="warning"
                                    icon="fas fa-file-invoice-dollar" />
                            </a>
                        </td>
                        <td>{{ $item->kunjungan->units->nama }}</td>
                        <td>{{ $item->pic }}</td>
                        <td>{{ $item->waktu }}</td>
                        <td class="text-right">{{ money($item->kunjungan->layanans->sum('harga'), 'IDR') }} </td>
                        <td class="text-right">
                            {{ money($item->kunjungan->resepfarmasidetails->sum('subtotal'), 'IDR') }} </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
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
