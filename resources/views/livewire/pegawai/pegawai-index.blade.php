<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Table Pegawai" theme="secondary">
            <div class="row ">
                <div class="col-md-6">
                    <a wire:navigate href="{{ route('pegawai.create') }}">
                        <x-adminlte-button class="btn-sm mb-3" label="Tambah Pegawai" theme="success"
                            icon="fas fa-user-plus" />
                    </a>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
            </div>
            <livewire:pegawai.pegawai-table lazy />
        </x-adminlte-card>
    </div>
</div>
