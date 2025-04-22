<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Referensi Jadwal Dokter" icon="fa fa-calendar-alt" theme="secondary">
            <div class="row">
                <div class="col-md-3">
                    <x-adminlte-input wire:model.live="kodepoli" name="kodepoli" label="Poliklinik" igroup-size="sm"
                        fgroup-class="row" label-class="text-left col-3" igroup-class="col-9">
                    </x-adminlte-input>
                    <x-search-table :isSearching="$searchingPoliklinik" :data="$polikliniks" :columns="['Kode Poliklinik', 'Nama Poliklinik']"
                        clickEvent="selectPoliklinik" />
                </div>
                <div class="col-md-3">
                    <x-adminlte-input wire:model="tanggal" type="date" name="tanggal" label="Tanggal"
                        igroup-size="sm" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='cari' theme="primary" label="Cari" />
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div wire:loading class="col-md-12">
                @include('components.placeholder.placeholder-text')
            </div>
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Hari</th>
                        <th>Dokter</th>
                        <th>Poliklinik</th>
                        <th>Subspesialis</th>
                        <th>Jampraktek</th>
                        <th>Kapasitas</th>
                        <th>Libur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwals as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->namahari }} ({{ $item->hari }})</td>
                            <td>{{ $item->namadokter }} ({{ $item->kodedokter }})</td>
                            <td>{{ $item->namapoli }} ({{ $item->kodepoli }})</td>
                            <td>{{ $item->namasubspesialis }} ({{ $item->kodesubspesialis }})</td>
                            <td>{{ $item->jadwal }}</td>
                            <td>{{ $item->kapasitaspasien }}</td>
                            <td>{{ $item->libur }}</td>
                            <td>
                                <a
                                    href="{{ route('antrian.antreandokter') }}?kodepoli={{ $item->kodepoli }}&kodedokter={{ $item->kodedokter }}&hari={{ $item->hari }}&jampraktek={{ $item->jadwal }}">
                                    <x-adminlte-button class="btn-xs" theme="primary" label="Antrian" />
                                </a>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
</div>
