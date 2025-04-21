<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Referensi Dokter" icon="fas fa-user-md" theme="secondary">
            @php
                $heads = ['#', 'Nama Dokter', 'Kode Dokter'];
            @endphp
            <x-adminlte-datatable id="table1" :heads="$heads" hoverable bordered compressed>
                @foreach ($dokters as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->namadokter }}</td>
                        <td>{{ $item->kodedokter }}</td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
</div>
