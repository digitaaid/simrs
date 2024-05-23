<div>
    <x-adminlte-card theme="primary" title="Pemeriksaan Dokter">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan" wire:click="editAntrian"
                wire:confirm='Apakah anda yakin akan menyimpan data antrian ?' />
            <x-adminlte-button wire:click='modalPemeriksaanDokter' theme="danger" class="btn-sm" icon="fas fa-times"
                label="Tutup" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
