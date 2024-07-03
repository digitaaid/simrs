<div id="icare">
    <x-adminlte-card theme="primary" title="I-Care JKN">
        @if ($icare)
            @if (flash()->message)
                <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                    {{ flash()->message }}
                </x-adminlte-alert>
            @endif
            <iframe src="{{ $url }}" width="100%" height="400px" frameborder="0"></iframe>
        @else
            ICare JKN Tidak Aktif / Pasien NON-JKN
        @endif
    </x-adminlte-card>
</div>
