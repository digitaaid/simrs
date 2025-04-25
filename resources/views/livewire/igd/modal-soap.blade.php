<div>
    <x-adminlte-card theme="primary" title="SOAP" icon="fas fa-ambulance">
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan" wire:click="simpan"
                wire:confirm='Apakah anda yakin akan simpan data ?' />
            <x-footer-card-message />
        </x-slot>
    </x-adminlte-card>
</div>
