<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Table User" theme="secondary">
            <livewire:user.user-table lazy />
            <x-slot name="footerSlot">
                <a wire:navigate href="{{ route('user.create') }}">
                    <x-adminlte-button class="btn-sm" label="Tambah User" theme="success" icon="fas fa-user-plus" />
                </a>
            </x-slot>
        </x-adminlte-card>
    </div>
</div>
