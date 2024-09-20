<div>
    <x-adminlte-card theme="primary" title="Layanan & Tindakan">
        <input type="hidden" name="kodebooking" wire:model="kodebooking">
        <input type="hidden" name="antrian_id" wire:model="antrian_id">
        <input type="hidden" name="kodekunjungan" wire:model="kodekunjungan">
        <input type="hidden" name="kunjungan_id" wire:model="kunjungan_id">
        <div class="row">
            <div class="col-md-6">
                <x-adminlte-input wire:model="nama" wire:change='pilihTindakan' list="tindakanlist" name="nama"
                    igroup-size="sm" label="Nama Tindakan/Layanan" fgroup-class="row" label-class="text-left col-4"
                    igroup-size="sm" igroup-class="col-8" />
                <datalist id="tindakanlist">
                    @foreach ($tindakans as $item => $harga)
                        <option value="{{ $item }}">{{ money($harga, 'IDR') }}</option>
                    @endforeach
                </datalist>
                <input type="hidden" name="tarif_id" wire:model="tarif_id">
                <input type="hidden" name="klasifikasi" wire:model="klasifikasi">
                <x-adminlte-select wire:model='jaminan' igroup-size="sm" fgroup-class="row"
                    label-class="text-left col-4" igroup-class="col-8" name="jaminan" label="Jaminan Pasien">
                    <option value=null disabled>Pilih Jaminan</option>
                    @foreach ($jaminans as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </x-adminlte-select>
                <x-adminlte-input wire:model="keterangan" name="keterangan" igroup-size="sm" label="keterangan"
                    fgroup-class="row" label-class="text-left col-4" igroup-size="sm" igroup-class="col-8" />
            </div>
            <div class="col-md-6">
                <x-adminlte-input wire:model.live="harga" wire:change="updateSubtotal" name="harga" igroup-size="sm"
                    label="harga" type="number" fgroup-class="row" label-class="text-left col-4" igroup-size="sm"
                    igroup-class="col-8" />
                <x-adminlte-input wire:model.live="jumlah" wire:change="updateSubtotal" name="jumlah" igroup-size="sm"
                    label="jumlah" type="number" fgroup-class="row" label-class="text-left col-4" igroup-size="sm"
                    igroup-class="col-8" />
                <x-adminlte-input wire:model.live="diskon" name="diskon" wire:change="updateSubtotal" igroup-size="sm"
                    label="diskon" type="number" fgroup-class="row" label-class="text-left col-4" igroup-size="sm"
                    igroup-class="col-8" />
                <x-adminlte-input wire:model="subtotal" name="subtotal" igroup-size="sm" label="subtotal" type="number"
                    fgroup-class="row" label-class="text-left col-4" igroup-size="sm" igroup-class="col-8" readonly />
            </div>
            <div class="col-md-12">
                <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                    wire:click="simpanLayanan" wire:confirm='Apakah anda ingin menyimpan tindakan/layanan ini ?' />
                <div wire:loading>
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                    </div>
                    Loading ...
                </div>
                @if (flash()->message)
                    <div class="text-{{ flash()->class }}" wire:loading.remove>
                        Loading Result : {{ flash()->message }}
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <table class="table text-nowrap table-sm table-hover table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jaminan</th>
                    <th>Harga</th>
                    <th>Disc</th>
                    <th>Jml</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                    <th>PIC</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($antrian->kunjungan->layanans as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jaminan }}</td>
                        <td class="text-right">{{ money($item->harga, 'IDR') }}</td>
                        <td>{{ $item->diskon }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td class="text-right">{{ money($item->subtotal, 'IDR') }}</td>
                        <td>
                            <button wire:click='editLayanan({{ $item }})'
                                class="btn btn-xs btn-primary">Edit</button>
                            <button wire:click='hapusLayanan({{ $item }})'
                                wire:confirm='Apakah anda yakin ingin menghapus layanan {{ $item->nama }} ?'
                                class="btn btn-xs btn-danger">Hapus</button>
                        </td>
                        <td>{{ $item->pic }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="6">Total</th>
                    <th class="text-right">{{ money($antrian->layanans?->sum('subtotal'), 'IDR') }}</th>
                    <th colspan="2"></th>
                </tr>
            </tfoot>
        </table>
        <x-slot name="footerSlot">
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
