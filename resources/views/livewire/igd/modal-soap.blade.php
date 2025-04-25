<div>
    <x-adminlte-card theme="primary" title="SOAP" icon="fas fa-ambulance">
        <table class="table table-sm table-bordered table-hover text-nowrap table-responsive-xl">
            <thead>
                <tr>
                    <th>
                        <x-adminlte-button theme="success" icon="fas fa-plus" class="btn-xs" title="Tambah SOAP"
                            wire:click="tambah" />
                    </th>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Dokter/PPA</th>
                    <th>Subject</th>
                    <th>Object</th>
                    <th>Assesment</th>
                    <th>Plan</th>
                    <th>Implementation</th>
                    <th>Evaluation</th>
                    <th>Revised</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soaps as $item)
                    <tr>
                        <td>
                            <x-adminlte-button theme="warning" icon="fas fa-edit" class="btn-xs" title="Edit SOAP"
                                wire:click="edit({{ $item->id }})" />
                            <x-adminlte-button theme="danger" icon="fas fa-trash" class="btn-xs" title="Hapus SOAP"
                                wire:click="hapus({{ $item->id }})" />
                        </td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->ppa }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->object }}</td>
                        <td>{{ $item->assesment }}</td>
                        <td>{{ $item->plan }}</td>
                        <td>{{ $item->implementation }}</td>
                        <td>{{ $item->evaluation }}</td>
                        <td>{{ $item->revised }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan" wire:click="simpan"
                wire:confirm='Apakah anda yakin akan simpan data ?' />
            <x-footer-card-message />
        </x-slot>
    </x-adminlte-card>
    @if ($showModal)
        <x-modal id="modal-soap" size="xl" title="Input SOAPIER" icon="fas fa-hand-holding-medical">
            <div class="row">
                <x-adminlte-input fgroup-class="col-md-6" igroup-size="sm" name="tanggal" label="Tanggal"
                    type="datetime-local" wire:model="tanggal" />
                <x-adminlte-input fgroup-class="col-md-6" igroup-size="sm" name="ppa" label="Dokter / PPA"
                    wire:model="ppa" />
                <x-adminlte-textarea fgroup-class="col-md-6" igroup-size="sm" name="subject" label="Subject"
                    wire:model="subject" />
                <x-adminlte-textarea fgroup-class="col-md-6" igroup-size="sm" name="object" label="Object"
                    wire:model="object" />
                <x-adminlte-textarea fgroup-class="col-md-6" igroup-size="sm" name="assesment" label="Assesment"
                    wire:model="assesment" />
                <x-adminlte-textarea fgroup-class="col-md-6" igroup-size="sm" name="plan" label="Plan"
                    wire:model="plan" />
                <x-adminlte-textarea fgroup-class="col-md-6" igroup-size="sm" name="implementation"
                    label="Implementation" wire:model="implementation" />
                <x-adminlte-textarea fgroup-class="col-md-6" igroup-size="sm" name="evaluation" label="Evaluation"
                    wire:model="evaluation" />
                <x-adminlte-textarea fgroup-class="col-md-6" igroup-size="sm" name="revised" label="Revised"
                    wire:model="revised" />
            </div>
            <x-slot name="footerSlot">
                <x-adminlte-button theme="success" label="Simpan" wire:click="simpan" />
                <x-adminlte-button theme="danger" label="Batal" wire:click="$set('showModal', false)" />
            </x-slot>
        </x-modal>
    @endif
</div>
