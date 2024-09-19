<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-6">
        @livewire('kamarbed.kamar-index', ['lazy' => true])
    </div>
    <div class="col-md-6">
        @livewire('kamarbed.bed-index', ['lazy' => true])
    </div>
</div>
