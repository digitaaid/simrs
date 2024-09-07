<div class="row">
    {{-- profile --}}
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="primary" theme-mode="outline">
            @include('livewire.igd.modal-profil-igd')
        </x-adminlte-card>
    </div>
    {{-- navigasi --}}
    @include('livewire.igd.modal-navigasi-igd')
</div>
