<div>
    <x-adminlte-card theme="primary" title="Layanan & Tindakan">
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>
                        <x-adminlte-button theme="success" icon="fas fa-plus" class="btn-xs" title="Tambah Layanan"
                            wire:click="tambah" />
                    </th>
                    <th>#</th>
                    <th>Layanan / Tindakan</th>
                    <th>Harga</th>
                    <th>Disc</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>PIC</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($layanans as $index => $item)
                    <tr>
                        <td>
                            <x-adminlte-button theme="danger" icon="fas fa-trash" class="btn-xs" title="Hapus Layanan"
                                wire:click="hapus({{ $index }})" />
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <x-adminlte-input name="nama" wire:model="layanans.{{ $index }}.nama"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                placeholder="Cari Nama Layanan / Tindakan"
                                wire:keyup="cariTindakan({{ $index }})" />
                            @if (!empty($searchingTindakan[$index]))
                                <x-search-table :isSearching="$searchingTindakan[$index]" :data="$tindakans" :columns="['ID', 'Tindakan/Layanan', 'Pasien', 'Klasifikasi', 'Harga']"
                                    clickEvent="pilihTindakan" />
                            @endif
                        </td>
                        <td>
                            <x-adminlte-input name="harga" wire:model="layanans.{{ $index }}.harga"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Masukan Harga"
                                oninput="this.value = formatRibuan(this.value)"
                                wire:keyup.debounce.1000ms="inputHarga({{ $index }})" />
                            @error('layanans.' . $index . '.harga')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <x-adminlte-input name="diskon" wire:model="layanans.{{ $index }}.diskon"
                                max="100" igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                placeholder="Masukan Diskon" oninput="this.value = formatRibuan(this.value)"
                                wire:keyup.debounce.1000ms="inputDiskon({{ $index }})" />
                            @error('layanans.' . $index . '.diskon')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>

                            <x-adminlte-input name="jumlah" wire:model="layanans.{{ $index }}.jumlah"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Masukan Jumlah"
                                oninput="this.value = formatRibuan(this.value)"
                                wire:keyup.debounce.1000ms="inputJumlah({{ $index }})" />
                            @error('layanans.' . $index . '.jumlah')
                                <span class="invalid-feedback d-block">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            <x-adminlte-input name="subtotal" wire:model="layanans.{{ $index }}.subtotal"
                                igroup-class="input-group-xs" fgroup-class="form-group-xs"
                                placeholder="Masukan Subtotal" disabled />
                        </td>
                        <td>{{ $item['pic'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <th colspan="6" class="text-right">Grand Total</th>
                <th>
                    <x-adminlte-input name="grandtotal" value="{{ $this->getGrandTotal() }}"
                        igroup-class="input-group-xs" fgroup-class="form-group-xs" placeholder="Masukan Grand Total"
                        disabled />
                </th>
                <th></th>
            </tfoot>
        </table>
        <x-slot name="footerSlot">
            <x-footer-card-message />
        </x-slot>
    </x-adminlte-card>
</div>
