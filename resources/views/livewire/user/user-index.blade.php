<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        @livewire('user.user-table', ['id' => null, 'form' => false, 'search' => '', 'sortBy' => 'name', 'sortDirection' => 'asc', 'lazy' => true])
    </div>
</div>
