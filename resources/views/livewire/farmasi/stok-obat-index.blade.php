    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="{{ $obat->real_stok }}" text="Stok Obat" theme="success" icon="fas fa-pills" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="0" text="Pemakaian" theme="warning" icon="fas fa-pills" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box title="0" text="Obat Masuk" theme="warning" icon="fas fa-pills" />
                </div>
            </div>
        </div>
        @if ($form)
            <div class="col-md-12">
                <x-adminlte-card title="Stok Obat Masuk" theme="primary">
                    <input type="hidden" wire:model="obat_id" name="obat_id">
                    <x-adminlte-input wire:model="nama_obat" fgroup-class="row" label-class="text-right col-4"
                        igroup-class="col-8" igroup-size="sm" name="nama_obat" label="Nama Obat" />
                    <x-adminlte-input wire:model="harga_kemasan" fgroup-class="row" label-class="text-right col-4"
                        igroup-class="col-8" igroup-size="sm" name="harga_kemasan" label="Harga/Kemasan" />
                    <x-adminlte-input wire:model="diskon_pembelian" fgroup-class="row" label-class="text-right col-4"
                        igroup-class="col-8" igroup-size="sm" name="diskon_pembelian" label="Diskon Pembelian" />
                    <x-adminlte-input wire:model="jumlah_kemasan" fgroup-class="row" label-class="text-right col-4"
                        igroup-class="col-8" igroup-size="sm" name="jumlah_kemasan" label="Jumlah Kemasan" />
                    <x-adminlte-input wire:model="konversi_satuan" fgroup-class="row" label-class="text-right col-4"
                        igroup-class="col-8" igroup-size="sm" name="konversi_satuan" label="Satuan/Kemasan" />
                    <x-adminlte-input wire:model="tgl_input" type="date" fgroup-class="row"
                        label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" name="tgl_input"
                        label="Tanggal Input" />
                    <x-adminlte-input wire:model="tgl_expire" type="date" fgroup-class="row"
                        label-class="text-right col-4" igroup-class="col-8" igroup-size="sm" name="tgl_expire"
                        label="Tanggal Expired" />
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
                        <x-adminlte-button wire:click='tambah' class="btn-sm mb-2" label="Tambah Obat Masuk"
                            theme="success" icon="fas fa-plus" />
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                    <thead>
                        <tr>
                            <th>Tgl Waktu</th>
                            <th>Kode</th>
                            <th>Tgl Expire</th>
                            <th>Nama</th>
                            <th>Harga/Kemasan</th>
                            <th>Diskon</th>
                            <th>Jumlah/Kemasan</th>
                            <th>Jumlah/Satuan</th>
                            <th>Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stoks as $stok)
                            <tr>
                                <th>{{ $stok->created_at }}</th>
                                <th>{{ $stok->kode }}</th>
                                <th>{{ $stok->tgl_expire }}</th>
                                <th>{{ $stok->harga_beli }}</th>
                                <th>{{ $stok->diskon_pembelian }}</th>
                                <th>{{ $stok->jumlah_kemasan }}</th>
                                <th>{{ $stok->jumlah_satuan }}</th>
                                <th>{{ $stok->total_harga }}</th>
                            </tr>
                        @endforeach
                    </tbody>
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
