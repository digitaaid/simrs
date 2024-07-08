<div id="laboratorium">
    <x-adminlte-card theme="primary" title="Riwayat Laboratoirum">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($form)
            <div id="editLaboratorium">
                <div class="row">
                    <input hidden wire:model="id" name="id">
                    <div class="col-md-6">
                        <x-adminlte-input wire:model='tanggal' name="tanggal" type='date' label="Tanggal Periksa"
                            fgroup-class="row" label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" />
                        <x-adminlte-input wire:model="norm" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="norm" label="No RM" readonly />
                        <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                        <x-adminlte-input wire:model="nik" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nik" label="NIK" />
                        <x-adminlte-input wire:model="nomorkartu" fgroup-class="row" label-class="text-left col-4"
                            igroup-class="col-8" igroup-size="sm" name="nomorkartu" label="No Kartu" />
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="file" class="text-left col-4">
                                File Laboratorium
                            </label>
                            <div class="input-group input-group-sm col-8">
                                <input id="file" type="file" name="file" class="form-control"
                                    wire:model="file">
                            </div>
                        </div>
                        <x-adminlte-textarea wire:model='pemeriksaan' name="pemeriksaan" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" igroup-size="sm" label="Pemeriksaan">
                        </x-adminlte-textarea>
                        <x-adminlte-textarea wire:model='hasil' name="hasil" fgroup-class="row"
                            label-class="text-left col-4" igroup-class="col-8" rows=5 igroup-size="sm"
                            label="Hasil/Expertise">
                        </x-adminlte-textarea>
                    </div>
                </div>
                <x-adminlte-button label="Simpan" class="btn-sm" icon="fas fa-save" wire:click="store"
                    wire:confirm="Apakah anda yakin ingin menyimpan hasil pemeriksaan tersebut ?" theme="success" />
                <x-adminlte-button wire:click='tambahLab' class="btn-sm" label="Tutup" theme="danger"
                    icon="fas fa-times" />
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
                <hr>
            </div>
        @endif
        <a href="#editLaboratorium">
            <x-adminlte-button wire:click='tambahLab' class="btn-sm" label="Upload Laboratorium" theme="success"
                icon="fas fa-user-plus" />
        </a>
        <br> <br>
        <table class="table table-bordered table-sm table-responsive-sm table-xl mb-2">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Pemeriksaan</th>
                    <th>Hasil/Expertise</th>
                    <th>Action</th>
                    <th>PIC</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($labs as $item)
                    <tr>
                        <td>{{ $item->tanggal }}</td>
                        <td>{{ $item->pemeriksaan }}</td>
                        <td>
                            <pre style="font-family: sans-serif; padding: 0px">{{ $item->hasil }}</pre>
                        </td>
                        <td>
                            <x-adminlte-button wire:click="lihatFile('{{ $item->id }}')" class="btn-xs"
                                label="Lihat" theme="success" icon="fas fa-eye" />
                            <x-adminlte-button wire:click="edit('{{ $item->id }}')" class="btn-xs"
                                theme="warning" icon="fas fa-edit" />
                            <x-adminlte-button wire:click="hapus('{{ $item->id }}')" class="btn-xs"
                                theme="danger" wire:confirm='Apakah anda yakin akan menghapus hasil Laboratorium tersebut ?' icon="fas fa-trash" />
                        </td>
                        <td>{{ $item->pic }}</td>
                    </tr>
                    @if ($lihat && $idLihat == $item->id)
                        <tr>
                            <td colspan="5">
                                <iframe src="{{ $item->fileurl }}" width="100%" height="500px"
                                    frameborder="0"></iframe>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        {{ $labs->links() }}
        <x-slot name="footerSlot">
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
