<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card title="Table Pasien" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <a href="{{ route('pasien.create') }}" wire:navigate>
                        <x-adminlte-button class="btn-sm" label="Tambah Pasien" theme="success"
                            icon="fas fa-user-plus" />
                    </a>
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Pasien"
                        igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            @php
                $heads = ['#', 'No RM', 'Nama Pasien', 'NIK', 'No BPJS', 'IdPatient', 'Updated', 'Action'];
                $config['order'] = [0, 'desc'];
                $config['paging'] = false;
                $config['searching'] = false;
                $config['info'] = false;
                $config['scrollX'] = true;
            @endphp
            <x-adminlte-datatable id="table1" class="text-nowrap" :heads="$heads" :config="$config" bordered hoverable
                compressed>
                @forelse ($pasiens as $item)
                    <tr wire:key="{{ $item->id }}">
                        <td>{{ $loop->index + $pasiens->firstItem() }}</td>
                        <td>{{ $item->norm }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nik }}</td>
                        <td>{{ $item->nomorkartu }}</td>
                        <td>{{ $item->idpatient }}</td>
                        <td>{{ $item->updated_at }}</td>
                        <td>
                            <a href="{{ route('pasien.edit', $item->norm) }}" wire:navigate>
                                <x-adminlte-button class="btn-xs" label="Edit" theme="warning" icon="fas fa-edit" />
                            </a>
                        </td>
                    </tr>
                @empty
                @endforelse
            </x-adminlte-datatable>
            {{ $pasiens->links() }}
        </x-adminlte-card>
    </div>
</div>
