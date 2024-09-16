    <div class="row">
        <div class="col-md-12">
            <x-adminlte-card title="Informasi Obat Masuk" theme="primary">
                <div class="row ">
                    <div class="col-md-8">
                        <x-adminlte-button wire:click='openForm' class="btn-sm mb-2" label="Tambah Obat Masuk"
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
                            <th>Jumlah</th>
                            <th>Harga Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </x-adminlte-card>
        </div>
        <div class="col-md-12">
            <x-adminlte-card title="Informasi Pemakaian Obat" theme="primary">
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
