<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @if ($form)
            <x-adminlte-card title="Detail Tindakan Pelayanan" theme="secondary">
                <form>
                    <input hidden wire:model="id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            {{-- $table->string('nama')->index();
                            $table->string('klasifikasi');
                            $table->string('jenispasien')->default('SEMUA');
                            $table->string('jasa_pelayanan')->default(0);
                            $table->string('jasa_rs')->default(0);
                            $table->string('harga')->default(0); --}}
                            <x-adminlte-input wire:model="nama" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="nama" label="Nama" />
                            <x-adminlte-select wire:model="klasifikasi" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="klasifikasi" label="klasifikasi">
                                <option value=null disabled>Pilih Klasifikasi Tindakan</option>
                                <option>Akomodasi</option>
                                <option>Keperawatan</option>
                                <option>Prosedur Non Bedah</option>
                                <option>Prosedur Bedah</option>
                                <option>Konsultasi</option>
                                <option>Penunjang</option>
                                <option>Pelayanan Darah</option>
                                <option>Rehabilitasi</option>
                                <option>Kamar</option>
                                <option>Rawat Intensif</option>
                                <option>Obat</option>
                                <option>Sewa Alat</option>
                                <option>BMHP</option>
                                <option>Alkes</option>
                                <option>Radiologi</option>
                                <option>Laboratorium</option>
                                <option>Tenaga Ahli</option>
                            </x-adminlte-select>
                            <x-adminlte-select wire:model="jenispasien" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="jenispasien" label="jenispasien">
                                <option value=null disabled>Pilih Jenis Pasien</option>
                                <option>SEMUA</option>
                                <option>JKN</option>
                                <option>NON-JKN</option>
                            </x-adminlte-select>
                            <x-adminlte-input wire:model="jasa_pelayanan" fgroup-class="row"
                                label-class="text-left col-4" igroup-class="col-8" igroup-size="sm"
                                name="jasa_pelayanan" type="number" label="jasa_pelayanan" />
                            <x-adminlte-input wire:model="jasa_rs" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="jasa_rs" type="number" label="jasa_rs" />
                            <x-adminlte-input wire:model="harga" fgroup-class="row" label-class="text-left col-4"
                                igroup-class="col-8" igroup-size="sm" name="harga" type="number" label="harga" />
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button label="Simpan" class="btn-sm" onclick="store()" icon="fas fa-save"
                        wire:click="store" wire:confirm="Apakah anda ingi menyimpan data tindakan ?" form="formUpdate"
                        theme="success" />
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tutup" theme="danger"
                        icon="fas fa-times" />
                </x-slot>
            </x-adminlte-card>
        @endif
        @if ($formImport)
            <x-adminlte-card title="Import Tindakan" theme="secondary">
                <x-adminlte-input-file wire:model='fileTindakanImport' name="fileTindakanImport"
                    placeholder="{{ $fileTindakanImport ? $fileTindakanImport->getClientOriginalName() : 'Pilih File Tindakan' }}"
                    igroup-size="sm" label="File Import" />
                <x-slot name="footerSlot">
                    <x-adminlte-button class="btn-sm" wire:click='import' class="mr-auto btn-sm" icon="fas fa-save"
                        theme="success" label="Import"
                        wire:confirm='Apakah anda yakin akan mengimport data Tindakan ?' />
                    <x-adminlte-button theme="danger" wire:click='openFormImport' class="btn-sm" icon="fas fa-times"
                        label="Tutup" data-dismiss="modal" />
                </x-slot>
            </x-adminlte-card>
        @endif
        <x-adminlte-card title="Table Tindakan" theme="secondary">
            <div class="row ">
                <div class="col-md-8">
                    <x-adminlte-button wire:click='openForm' class="btn-sm" label="Tambah Tindakan" theme="success"
                        icon="fas fa-user-plus" />
                    <x-adminlte-button wire:click='export'
                        wire:confirm='Apakah anda yakin akan mendownload data semua Tindakan ? ' class="btn-sm"
                        label="Export" theme="primary" icon="fas fa-upload" />
                    <x-adminlte-button wire:click='openFormImport' class="btn-sm" label="Import" theme="primary"
                        icon="fas fa-download" />
                </div>
                <div class="col-md-4">
                    <x-adminlte-input wire:model.live="search" name="search" placeholder="Pencarian Tindakan"
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
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl mb-3">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Klasifikasi</th>
                        <th>Jenis Pasien</th>
                        <th>Jasa Pelayanan</th>
                        <th>Jasa RS</th>
                        <th>Harga</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>PIC</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tindakans as $item)
                        <tr wire:key="{{ $item->id }}">
                            <td>{{ $loop->index + $tindakans->firstItem() }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->klasifikasi }}</td>
                            <td>{{ $item->jenispasien }}</td>
                            <td>{{ $item->jasa_pelayanan ? money($item->jasa_pelayanan, 'IDR') : 'Rp 0' }} </td>
                            <td>{{ $item->jasa_rs ? money($item->jasa_rs, 'IDR') : 'Rp 0' }}</td>
                            <td>{{ $item->harga ? money($item->harga, 'IDR') : 'Rp 0' }}</td>
                            <td>
                                <x-adminlte-button wire:click='edit({{ $item }})' class="btn-xs"
                                    label="Edit" theme="warning" icon="fas fa-edit" />
                            </td>
                            <td>
                                @if ($item->status)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $item->pic }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tindakans->links() }}
        </x-adminlte-card>
    </div>
</div>
