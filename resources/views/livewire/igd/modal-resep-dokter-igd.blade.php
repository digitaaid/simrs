<div>
    <x-adminlte-card theme="primary" title="Resep Obat Dokter" icon="fas fa-file-receipt"
        icon="fas fa-prescription-bottle-alt">
        <table class="table table-sm table-bordered text-nowrap table-responsive-xl">
            <thead>
                <tr>
                    <th>
                        <x-adminlte-button theme="success" icon="fas fa-plus" class="btn-xs" title="Tambah Layanan"
                            wire:click="tambah" />
                    </th>
                    <th>#</th>
                    <th>Nama Obat</th>
                    <th>Dosis</th>
                    <th>Cara Pakai</th>
                    <th style="width: 75px;">Jumlah</th>
                    <th>Keterangan</th>
                    <th>PIC</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resepObat as $index => $item)
                    <tr>
                        <td>
                            <x-adminlte-button theme="danger" icon="fas fa-trash" class="btn-xs" title="Hapus Obat"
                                wire:click="hapus({{ $index }})" />
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <x-adminlte-input name="nama" wire:model="resepObat.{{ $index }}.nama"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Cari Nama Obat"
                                wire:keyup.debounce.300ms="cariObat({{ $index }})"
                                wire:click="cariObat({{ $index }})" />
                            @if (!empty($searchingObat[$index]) && !empty($obats))
                                <x-search-table :isSearching="$searchingObat[$index]" :data="$obats" :columns="['ID', 'Nam Obat', 'Satuan', 'Merk', 'Harga']"
                                    clickEvent="pilihObat" />
                            @endif
                            @error('resepObat.' . $index . '.nama')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </td>
                        </td>
                        <td>
                            <x-adminlte-input name="frekuensi" wire:model="resepObat.{{ $index }}.frekuensi"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Masukan Dosis"
                                wire:keyup.debounce.300ms="cariFrekuensi({{ $index }})"
                                wire:click="cariFrekuensi({{ $index }})" />
                            @if (!empty($searchingFrekuensi[$index]) && !empty($frekuensis))
                                <x-search-table :isSearching="$searchingFrekuensi[$index]" :data="$frekuensis" :columns="['Dosis']"
                                    clickEvent="pilihFrekuensi" />
                            @endif
                        </td>
                        <td>
                            <x-adminlte-input name="waktu" wire:model="resepObat.{{ $index }}.waktu"
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
                            <x-adminlte-input wire:model="resepObat.{{ $index }}.jumlah" name="jumlah"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" type="number"
                                placeholder="Jumlah Obat" />
                            @error('resepObat.' . $index . '.jumlah')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <x-adminlte-input wire:model="resepObat.{{ $index }}.keterangan" name="keterangan"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Keterangan" />
                        </td>
                        <td>
                            <x-adminlte-button class="btn-xs" title="{{ $item['pic'] }}"
                                label="{{ $item['updated_at'] }}" />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-slot name="footerSlot">
            <x-adminlte-button wire:confirm='Apakah anda yakin akan menyimpan resep obat terbaru ini ?'
                wire:click='simpan' class="btn-sm" label="Simpan" theme="success" icon="fas fa-save" />
            <x-footer-card-message />
        </x-slot>
    </x-adminlte-card>
</div>
