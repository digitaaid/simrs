    <div class="row">
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
                </table>

            </x-adminlte-card>
        </div>
    </div>
