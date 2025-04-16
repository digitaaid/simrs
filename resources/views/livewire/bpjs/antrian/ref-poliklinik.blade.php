<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Referensi Poliklinik" theme="secondary" icon="fas fa-clinic-medical">
            @php
                $heads = ['#', 'Nama Poliklinik', 'Kode Poliklinik', 'Nama Subspesialis', 'Kode Subspesialis'];
            @endphp
            <x-adminlte-datatable id="table1" :heads="$heads" hoverable bordered compressed>
                @foreach ($polikliniks as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nmpoli }}</td>
                        <td>{{ $item->kdpoli }}</td>
                        <td>{{ $item->nmsubspesialis }}</td>
                        <td>{{ $item->kdsubspesialis }}</td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </x-adminlte-card>
    </div>
</div>
