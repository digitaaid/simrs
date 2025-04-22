<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="List Taskid" theme="secondary" icon="fas fa-user-clock">
            <div class="row">
                <div class="col-md-5">
                    <x-adminlte-input wire:model='kodebooking' name="kodebooking" fgroup-class="row"
                        label-class="text-left col-4" igroup-class="col-8" label="Kodebooking" igroup-size="sm">
                        <x-slot name="appendSlot">
                            <x-adminlte-button wire:click='cari' theme="primary" label="Cari" />
                        </x-slot>
                    </x-adminlte-input>
                </div>
                <div class="col-md-7">
                    <div wire:loading class="col-md-12">
                        @include('components.placeholder.placeholder-text')
                    </div>
                    <table class="table table-sm table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Taskid</th>
                                <th>Kodebooking</th>
                                <th>Taskname</th>
                                <th>Waktu RS</th>
                                <th>Waktu Server</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($taskid as $item)
                                <tr>
                                    <td>{{ $item->taskid }}</td>
                                    <td>{{ $item->kodebooking }}</td>
                                    <td>{{ $item->taskname }}</td>
                                    <td>{{ $item->wakturs }}</td>
                                    <td>{{ $item->waktu }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </x-adminlte-card>
    </div>
</div>
