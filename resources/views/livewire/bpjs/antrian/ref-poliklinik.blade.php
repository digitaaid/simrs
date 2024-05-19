<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        @forelse ($polikliniks as $item)
            {{ $item->nmpoli }} <br>
        @empty
            <p>No polikliniks found.</p>
        @endforelse
        {{-- @livewire('pegawai.pegawai-table', ['id' => null, 'form' => false, 'search' => '', 'sortBy' => 'name', 'sortDirection' => 'asc', 'lazy' => true]) --}}
    </div>
</div>
