<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif
    <div class="col-md-12">
        <x-adminlte-card title="Whatsapp Integrastion User" theme="primary">
            <form>
                <x-adminlte-input wire:model="number" fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                    igroup-size="sm" name="number" label="Number" />
                <x-adminlte-textarea rows=5 wire:model="message" fgroup-class="row" label-class="text-left col-3"
                    igroup-class="col-9" igroup-size="sm" name="message" label="Message" />

            </form>
            <x-slot name="footerSlot">
                <x-adminlte-button label="Kirim" wire:click="kirim" wire:confirm="Apakah anda ingin mengirim pesan ?"
                    theme="success" icon="fas fa-save" />
            </x-slot>
        </x-adminlte-card>
    </div>
    <div class="col-md-6" wire:poll.1000ms>
        <x-adminlte-card title="Whatsapp Integrastion User" theme="primary">
            @foreach ($qr as $item)
                {!! QrCode::size(300)->generate($item->qr) !!} <br>
                {{ $item->created_at }} Tolong scan QR Whastapp Yang Terbaru<br>
            @endforeach
        </x-adminlte-card>
    </div>
    <div class="col-md-6" wire:poll.1000ms>
        <x-adminlte-card title="Whatsapp Log" theme="primary">
            @foreach ($logs as $log)
                {{ $log->created_at }} {{ $log->type }} {{ $log->status }} <br>
            @endforeach
        </x-adminlte-card>
    </div>
</div>
