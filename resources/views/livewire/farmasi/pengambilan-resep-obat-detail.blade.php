<div class="col-md-12">
    <x-adminlte-card title="Resep Obat {{ $antrian->nama }}" theme="primary">
        <h6>Resep Obat</h6>
        @foreach ($resepObat as $index => $obat)
            <div class="row">
                <div class="col-md-2">
                    @error('resepObat.' . $index . '.obat')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.obat" list="obatlist" name="obat[]"
                        igroup-size="sm" placeholder="Nama Obat" />
                    <datalist id="obatlist">
                        @foreach ($obats as $key => $item)
                            <option value="{{ $item }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-2">
                    @error('resepObat.' . $index . '.jumlahobat')
                        <span class="invalid-feedback d-block">{{ $message }}</span>
                    @enderror
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.jumlahobat" name="jumlahobat[]"
                        igroup-size="sm" type="number" placeholder="Jumlah Obat" />
                </div>
                <div class="col-md-2">
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.frekuensiobat" list="frekuensiobatlist"
                        name="frekuensiobat[]" igroup-size="sm" placeholder="Frekuensi Obat" />
                    <datalist id="frekuensiobatlist">
                        @foreach ($frekuensiObats as $key => $item)
                            <option value="{{ $item }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-2">
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.waktuobat" list="waktuobatlist"
                        name="waktuobat[]" igroup-size="sm" placeholder="Waktu Obat" />
                    <datalist id="waktuobatlist">
                        @foreach ($waktuObats as $key => $item)
                            <option value="{{ $item }}"></option>
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-2">
                    <x-adminlte-input wire:model="resepObat.{{ $index }}.keterangan" name="keterangan[]"
                        igroup-size="sm" placeholder="Keterangan" />
                </div>
                <div class="col-md-2">
                    <button wire:click.prevent="removeObat({{ $index }})" class="btn btn-danger btn-sm">Hapus
                        Obat</button>
                </div>
            </div>
        @endforeach
        <button wire:click.prevent="addObat" class="btn btn-success btn-sm">Tambah Obat</button>
    </x-adminlte-card>
</div>
