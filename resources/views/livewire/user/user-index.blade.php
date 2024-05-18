<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <div class="col-md-12">
                <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                    {{ flash()->message }}
                </x-adminlte-alert>
            </div>
        @endif
    </div>
    <div class="col-md-12">
        <livewire:user.user-controller lazy />
    </div>
</div>
