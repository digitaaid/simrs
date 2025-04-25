<div>
    <x-adminlte-card theme="primary" title="Resep Obat Dokter" icon="fas fa-file-receipt">
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
                    <th style="width: 75px;">Jumlah</th>
                    <th>Cara Pakai</th>
                    <th>Keterangan</th>
                    <th>PIC</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($resepobatdetails as $index => $item)
                    <tr>
                        <td>
                            <x-adminlte-button theme="danger" icon="fas fa-trash" class="btn-xs" title="Hapus Obat"
                                wire:click="hapus({{ $index }})" />
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <x-adminlte-input name="nama" wire:model="resepobatdetails.{{ $index }}.nama"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Cari Nama Obat"
                                wire:keyup.debounce.500ms="cariObat({{ $index }})" />
                            @if (!empty($searchingObat[$index]) && !empty($obats))
                                <x-search-table :isSearching="$searchingObat[$index]" :data="$obats" :columns="['ID', 'Nam Obat', 'Satuan', 'Merk']"
                                    clickEvent="pilihObat" />
                            @endif
                        </td>
                        <td>
                            <x-adminlte-input name="frekuensi"
                                wire:model="resepobatdetails.{{ $index }}.frekuensi"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Masukan Dosis"
                                wire:keyup.debounce.500ms="cariFrekuensi({{ $index }})" />
                            @if (!empty($searchingFrekuensi[$index]) && !empty($frekuensis))
                                <x-search-table :isSearching="$searchingFrekuensi[$index]" :data="$frekuensis" :columns="['Dosis']"
                                    clickEvent="pilihFrekuensi" />
                            @endif
                        </td>
                        <td>
                            <x-adminlte-input name="jumlah" wire:model="resepobatdetails.{{ $index }}.jumlah"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Masukan Jumlah"
                                wire:keyup.debounce.1000ms="inputJumlah({{ $index }})" />
                            @error('resepobatdetails.' . $index . '.jumlah')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <x-adminlte-input name="waktu" wire:model="resepobatdetails.{{ $index }}.waktu"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                placeholder="Masukan Cara Pakai"
                                wire:keyup.debounce.500ms="cariWaktu({{ $index }})" />
                            @if (!empty($searchingWaktu[$index]) && !empty($waktus))
                                <x-search-table :isSearching="$searchingWaktu[$index]" :data="$waktus" :columns="['Cara Pakai']"
                                    clickEvent="pilihWaktu" />
                            @endif
                        </td>
                        <td>
                            <x-adminlte-input name="keterangan"
                                wire:model="resepobatdetails.{{ $index }}.keterangan"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                placeholder="Masukan Keterangan"
                                wire:keyup.debounce.1000ms="inputKeterangan({{ $index }})" />
                            @error('resepobatdetails.' . $index . '.keterangan')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
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
            <x-footer-card-message />
        </x-slot>
    </x-adminlte-card>
</div>
