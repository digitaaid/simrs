<div class="row">
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        @livewire('user.user-table', ['id' => null, 'form' => false, 'search' => '', 'sortBy' => 'name', 'sortDirection' => 'asc', 'lazy' => true])
    </div>
</div>
