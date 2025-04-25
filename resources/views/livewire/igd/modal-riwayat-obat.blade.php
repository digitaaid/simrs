<div>
    <x-adminlte-card theme="primary" title="Riwayat Penggunaan Obat" icon="fas fa-ambulance">
        <table class="table table-sm table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        <x-adminlte-button theme="success" icon="fas fa-plus" class="btn-xs" title="Tambah obat"
                            wire:click="tambahObat" />
                    </th>
                    <th>#</th>
                    <th>Nama Obat</th>
                    <th>Dosis</th>
                    <th style="width: 75px;">Jumlah</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($riwayatObat as $index => $obat)
                    <tr>
                        <th>
                            <x-adminlte-button theme="danger" icon="fas fa-times" class="btn-xs" title="Hapus obat"
                                wire:click="hapusObat({{ $index }})" />
                        </th>
                        <th>{{ $index + 1 }}</th>
                        <th>
                            <x-adminlte-input wire:model="riwayatObat.{{ $index }}.namaobat" name="namaobat"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                wire:keyup="cariObat({{ $index }})" placeholder="Cari obat..." />
                            @if (!empty($searchingObat[$index]) && !empty($obats[$index]))
                                <x-search-table :isSearching="$searchingObat[$index]" :data="$obats[$index]" :columns="['ID', 'Nama Obat', 'Satuan', 'Merk']"
                                    clickEvent="pilihObat" />
                            @endif
                        </th>
                        <th>
                            <x-adminlte-input wire:model="riwayatObat.{{ $index }}.dosis" name="dosis"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" />
                        </th>
                        <th>
                            <x-adminlte-input wire:model="riwayatObat.{{ $index }}.jumlahobat" name="jumlahobat"
                                type='number' igroup-class="input-group-xs" fgroup-class="form-group-xs" />
                        </th>
                        <th>
                            <x-adminlte-input wire:model="riwayatObat.{{ $index }}.waktu" name="waktu"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" />
                        </th>
                        <th>
                            <x-adminlte-input wire:model="riwayatObat.{{ $index }}.keterangan" name="keterangan"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" />
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                wire:click="simpan" wire:confirm='Apakah anda yakin akan simpan data ?' />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary">
                </div>
                Loading ...
            </div>
            @if (flash()->message)
                <div class="text-{{ flash()->class }}" wire:loading.remove>
                    Loading Result : {{ flash()->message }}
                </div>
            @endif
        </x-slot>
    </x-adminlte-card>
</div>
