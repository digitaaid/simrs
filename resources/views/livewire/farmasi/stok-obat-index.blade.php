    <div class="row">
        <div class="col-md-12">
            <x-adminlte-card title="Informasi Pemakaian Obat" theme="primary">
                <table class="table text-nowrap table-sm table-hover table-bordered mb-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode Resep</th>
                            <th>Nama Obat</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($resepfarmasidetails as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->koderesep }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>{{ $item->subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </x-adminlte-card>
        </div>
    </div>
