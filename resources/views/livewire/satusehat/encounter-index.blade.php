<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box
                    title="{{ count($antrians) ? $antrians->where('taskid', '!=', 99)->count() : '-' }}"
                    text="Total Antrian" theme="success" icon="fas fa-user-injured" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box
                    title="{{ count($antrians) ? $antrians->where('jenispasien', 'JKN')->count() : '-' }}"
                    text="Pasien JKN" theme="primary" icon="fas fa-user-injured" />
            </div>
            <div class="col-lg-3 col-6">
                <x-adminlte-small-box
                    title="{{ count($antrians) ? $antrians->where('jenispasien', 'NON-JKN')->count() : '-' }}"
                    text="Pasien NON-JKN" theme="primary" icon="fas fa-user-injured" />
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <x-adminlte-card title="Table Antrian Pendaftaran" theme="secondary">
            <div class="row">
                <div class="col-md-4">
                    <x-adminlte-input wire:model.change='tanggalperiksa' type="date" name="tanggalperiksa"
                        igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='caritanggal' theme="primary" label="Pilih" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live='search' name="search"
                        placeholder="Pencarian Berdasarkan Nama / No RM" igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='caritanggal' theme="primary" label="Cari" />
                        </x-slot>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-sm table-bordered text-nowrap table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Kode</th>
                            <th>EncounterId</th>
                            <th>No RM</th>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>PatientId</th>
                            <th>Dokter</th>
                            <th>PractitionerId</th>
                            <th>Unit</th>
                            <th>OrganizationId</th>
                            <th>LocationId</th>
                            <th>Diag 1</th>
                            <th>Conditition</th>
                        </tr>
                    </thead>
                    <tbody>
                        @isset($antrians)
                            @foreach ($antrians as $item)
                                <tr>
                                    <td>{{ $item->angkaantrean }}</td>
                                    <td>{{ $item->tanggalperiksa }}</td>
                                    <td>{{ $item->kunjungan?->kode }}</td>
                                    <td>
                                        @if ($item->kunjungan?->idencounter)
                                            <a class="badge badge-primary"
                                                href="{{ route('satusehat.encounter.edit', $item->kunjungan->idencounter) }}">
                                                {{ $item->kunjungan?->idencounter }}
                                            </a>
                                        @else
                                        @endif
                                        <x-adminlte-button wire:click="createEncounter('{{ $item->kunjungan->kode }}')"
                                            class="btn-xs" theme="warning" icon="fas fa-sync" />
                                    </td>
                                    <td>{{ $item->norm }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->nik }} </td>
                                    <td>{{ $item->pasien?->idpatient }} </td>
                                    <td>{{ $item->dokters?->nama }} </td>
                                    <td>{{ $item->dokters?->idpractitioner }} </td>
                                    <td>{{ $item->units?->nama }} </td>
                                    <td>{{ $item->units?->idorganization }} </td>
                                    <td>{{ $item->units?->idlocation }} </td>
                                    <td>{{ $item->asesmenrajal?->icd1 }} </td>
                                    <td>
                                        {{ $item->kunjungan?->idconditition }}
                                        <x-adminlte-button wire:click="createConditition('{{ $item->kunjungan->kode }}')"
                                            class="btn-xs" theme="warning" icon="fas fa-sync" />
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                    </tbody>
                </table>
            </div>
        </x-adminlte-card>
    </div>
</div>
