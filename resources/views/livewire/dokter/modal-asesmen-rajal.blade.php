<div>
    <x-adminlte-card theme="primary" title="Asesmen Rawat Jalan">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-slot name="footerSlot">
            <x-adminlte-button wire:click='modalAsesmenRajal' theme="danger" class="btn-sm" icon="fas fa-times"
                label="Tutup" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
