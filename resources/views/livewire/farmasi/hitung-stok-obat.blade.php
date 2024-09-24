<div class="row">
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $obataktif ?? '-' }}" text="Semua Obat" theme="success"
            icon="fas fa-pills" />
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $stokterbatas ?? '-' }}" text="Stok Obat Minimum" theme="danger" icon="fas fa-pills"
            url="{{ route('obat.index') }}?filter=minimum" url-text="View details" />
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $stokminus ?? '-' }}" text="Stok Obat Minus" theme="danger" icon="fas fa-pills"
            url="{{ route('obat.index') }}?filter=minus" url-text="View details" />
    </div>
</div>
