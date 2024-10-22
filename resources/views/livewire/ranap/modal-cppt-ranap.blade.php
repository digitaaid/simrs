<div>
    <x-adminlte-card theme="primary" title="CPPT Rawat Inap" icon="fas fa-file-medical">
        <div class="table-responsive">
            <table class="table table-sm table-bordered  table-xl mb-2">
                <thead>
                    <tr>
                        <th>Tgl Input</th>
                        <th>Hasil Asesmen & Pemberian Pelayanan</th>
                        <th>Instruksi</th>
                        <th>Action</th>
                        <th>Profesi</th>
                        <th>Dokter</th>
                    </tr>
                </thead>
                <tbody>
                    <style>
                        pre {
                            font-size: 14 !important;
                            padding: 0 !important;
                            margin: 0 !important;
                        }
                    </style>
                    @foreach ($inputs as $cppt)
                        <tr>
                            <td>{{ $cppt->tgl_input }}</td>
                            <td>
                                @if ($cppt->subjective)
                                    <b>Subjective : </b>
                                    <pre>{{ $cppt->subjective }}</pre>
                                @endif
                                @if ($cppt->objective)
                                    <b>Objective : </b>
                                    <pre>{{ $cppt->objective }}</pre>
                                @endif
                                @if ($cppt->assessment)
                                    <b>Assessment : </b>
                                    <pre>{{ $cppt->assessment }}</pre>
                                @endif
                                @if ($cppt->plan)
                                    <b>Plan : </b>
                                    <pre>{{ $cppt->plan }}</pre>
                                @endif
                            </td>
                            <td>{{ $cppt->instruksi }}</td>
                            <td>
                                <a href="#editCppt">
                                    <x-adminlte-button theme="warning" class="btn-xs"
                                        wire:click="editCppt('{{ $cppt->id }}')" icon="fas fa-edit" />
                                </a>
                                <x-adminlte-button theme="danger" class="btn-xs"
                                    wire:click="hapusCppt('{{ $cppt->id }}')"
                                    wire:confirm='Apakah anda yakin ingin menghapus data teresebut ?'
                                    icon="fas fa-trash" />
                            </td>
                            <td>{{ $cppt->profesi }}</td>
                            <td>{{ $cppt->dokter_dpjp }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="warning" icon="fas fa-edit" class="btn-sm" label="Input CPPT"
                wire:click="inputCppt" />
            <a href="{{ route('print.cpptranap') }}?kode={{ $kunjungan->kode }}" target="_blank">
                <x-adminlte-button theme="primary" icon="fas fa-print" class="btn-sm" label="Print" />
            </a>
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
            @if (flash()->message)
                <div class="text-{{ flash()->class }}" wire:loading.remove>
                    Loading Result : {{ flash()->message }}
                </div>
            @endif
        </x-slot>
        <div id="editCppt">
        </div>
    </x-adminlte-card>
    @if ($form)
        <x-adminlte-card theme="warning" title="Input CPPT Pasien Rawat Inap" icon="fas fa-edit">
            <input type="hidden" wire:model="id" name="id">
            <x-adminlte-input wire:model="tgl_input" type='datetime-local' fgroup-class="row"
                label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" name="tgl_input"
                label="Tanggal Masuk" />
            <x-adminlte-input wire:model="profesi" fgroup-class="row" label-class="text-left col-4" igroup-class="col-8"
                igroup-size="sm" name="profesi" label="Profesi" />
            <x-adminlte-textarea igroup-size="sm" rows=4 label="Subjective" name="subjective" wire:model="subjective" />
            <x-adminlte-textarea igroup-size="sm" rows=4 label="Objective" name="objective" wire:model="objective" />
            <x-adminlte-textarea igroup-size="sm" rows=4 label="Assesment" name="assessment" wire:model="assessment" />
            <x-adminlte-textarea igroup-size="sm" rows=4 label="Plan" name="plan" wire:model="plan" />
            <x-adminlte-input wire:model="instruksi" fgroup-class="row" label-class="text-left col-4"
                igroup-class="col-8" igroup-size="sm" name="instruksi" label="Dokter Jaga" />
            <x-adminlte-input wire:model="dokter_dpjp" fgroup-class="row" label-class="text-left col-4"
                igroup-class="col-8" igroup-size="sm" name="dokter_dpjp" label="Dokter DPJP" />
            <x-slot name="footerSlot">
                <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan" wire:click="simpan"
                    wire:confirm='Apakah anda yakin akan menyimpan data diatas ?' />
                <x-adminlte-button theme="danger" icon="fas fa-times" class="btn-sm" label="Tutup"
                    wire:click="inputCppt" />
                <div wire:loading>
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                    </div>
                    Loading ...
                </div>
                @if (flash()->message)
                    <div class="text-{{ flash()->class }}" wire:loading.remove>
                        Loading Result : {{ flash()->message }}
                    </div>
                @endif
            </x-slot>
        </x-adminlte-card>
    @endif
</div>
