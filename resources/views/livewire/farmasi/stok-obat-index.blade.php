    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $obat->real_stok }}" text="Stok Obat" theme="success"
                        icon="fas fa-pills" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $stoks->sum('jumlah_satuan') }}" text="Obat Masuk" theme="warning"
                        icon="fas fa-pills" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $resepfarmasidetails->sum('jumlah') }}" text="Pemakaian"
                        theme="warning" icon="fas fa-pills" />
                </div>

            </div>
        </div>
        @if ($form)
            <div class="col-md-12">
                <x-adminlte-card title="Stok Obat Masuk" theme="primary">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="hidden" wire:model="obat_id" name="obat_id">
                            <x-adminlte-input wire:model="nama_obat" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="nama_obat" label="Nama Obat" />
                            <x-adminlte-input wire:model="harga_beli" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="harga_beli" label="Harga Beli/Kemasan" />
                            <x-adminlte-input wire:model="pajak_ppn" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="pajak_ppn" label="Pajak PPN" />
                            <x-adminlte-input wire:model="diskon_beli" fgroup-class="row" label-class="text-right col-4"
                                igroup-class="col-8" igroup-size="sm" name="diskon_beli" label="Diskon Pembelian" />
                            <x-adminlte-input wire:model="tgl_input" type="date" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" name="tgl_input"
                                label="Tanggal Input" />
                            <x-adminlte-input wire:model="tgl_expire" type="date" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" name="tgl_expire"
                                label="Tanggal Expired" />
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input wire:model="jumlah_kemasan" type="number" min=0 fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="jumlah_kemasan" label="Jumlah Kemasan" />
                            <x-adminlte-input wire:model="konversi_satuan" type="number" fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="konversi_satuan" label="Konversi Satuan" min=1 />
                            <x-adminlte-input wire:model="jumlah_satuan" type="number" min=0 fgroup-class="row"
                                label-class="text-right col-4" igroup-class="col-8" igroup-size="sm"
                                name="jumlah_satuan" label="Jumlah Satuan" />
                        </div>
                    </div>
                    <x-slot name="footerSlot">
                        <x-adminlte-button class="btn-sm" wire:click='store' class="mr-auto btn-sm" icon="fas fa-save"
                            theme="success" label="Simpan"
                            wire:confirm='Apakah anda yakin akan menambahkan stok obat ?' />
                        <x-adminlte-button theme="danger" wire:click='tambah' class="btn-sm" icon="fas fa-times"
                            label="Tutup" data-dismiss="modal" />
                    </x-slot>
                </x-adminlte-card>
            </div>
        @endif
        <div class="col-md-12">
            <x-adminlte-card title="Informasi Obat Masuk" theme="secondary">
                <div class="row ">
                    <div class="col-md-8">
                        <a href="{{ route('obat.index') }}">
                            <x-adminlte-button class="btn-sm mb-2" label="Kembali" theme="danger"
                                icon="fas fa-arrow-left" />
                        </a>
                        <x-adminlte-button wire:click='tambah' class="btn-sm mb-2" label="Tambah Obat Masuk"
                            theme="success" icon="fas fa-plus" />
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Tgl Input</th>
                            <th>Tgl Expire</th>
                            <th>Nama</th>
                            <th>Harga/Kemasan</th>
                            <th>Harga+PPN</th>
                            <th>Diskon</th>
                            <th>Jumlah/Kemasan</th>
                            <th>Jumlah/Satuan</th>
                            <th>Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stoks as $stok)
                            <tr>
                                <td>{{ $stok->kode }}</td>
                                <td>{{ $stok->tgl_input }}</td>
                                <td>{{ $stok->tgl_expire }}</td>
                                <td>{{ $stok->nama }}</td>
                                <td>{{ money($stok->harga_beli, 'IDR') }}</td>
                                <td>{{ money($stok->harga_beli + ($stok->harga_beli * 11) / 100, 'IDR') }} (11%)</td>
                                <td>{{ $stok->diskon_beli }}</td>
                                <td>{{ $stok->jumlah_kemasan }}</td>
                                <td>{{ $stok->jumlah_satuan }}</td>
                                <td>{{ money($stok->total_harga, 'IDR') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="9">Total</th>
                            <th colspan="9">{{ money($stoks->sum('total_harga'), 'IDR') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </x-adminlte-card>
        </div>
        <div class="col-md-12">
            <x-adminlte-card title="Informasi Pemakaian Obat" theme="secondary">
                <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tgl Waktu</th>
                            <th>Kode Resep</th>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>No RM</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Farmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resepfarmasidetails as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->koderesep }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ money($item->harga, 'IDR') }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ money($item->subtotal, 'IDR') }}</td>
                                <td>{{ $item->kunjungan->norm }}</td>
                                <td>{{ $item->kunjungan->nama }}</td>
                                <td>{{ $item->antrian->namadokter }}</td>
                                <td>{{ $item->antrian?->pic4?->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total</th>
                            <th>{{ $resepfarmasidetails->sum('jumlah') }}</th>
                            <th>{{ money($resepfarmasidetails->sum('subtotal'), 'IDR') }}</th>
                            <th colspan="4"></th>
                        </tr>
                    </tfoot>
                </table>
            </x-adminlte-card>
        </div>
    </div>
