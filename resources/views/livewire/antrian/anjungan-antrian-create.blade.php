<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-green text-white p-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <img src="{{ asset('kitasehat/logokitasehat-lingkar.png') }}" width="80">
                                    <div class="col">
                                        <h2>Anjungan Antrian</h2>
                                        <h4>{{ env('APP_NAME_LONG') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1>{{ env('APP_NAME') }}</h1>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        @if (!$pasienbaru && $jenispasien == 'JKN')
            <div class="col-md-12">
                <x-adminlte-card class="m-2" title="Pilih Jadwal Dokter {{ $jenispasien }}" theme="green"
                    icon="fas fa-user-md">
                    <h1>Pasien {{ $pasienbaru ? 'Baru' : 'Lama' }} {{ $jenispasien }}</h1>
                    @if (flash()->message)
                        <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }}">
                            {{ flash()->message }}
                        </x-adminlte-alert>
                    @endif
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" wire:model.live='inputidentitas'
                                value="nik" id="customRadio1" name="customRadio">
                            <label for="customRadio1" class="custom-control-label">NIK Pasien</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input class="custom-control-input" type="radio" wire:model.live='inputidentitas'
                                value="nomorkartu" id="customRadio2" name="customRadio">
                            <label for="customRadio2" class="custom-control-label">Nomor Kartu BPJS</label>
                        </div>
                    </div>
                    @if ($inputidentitas == 'nik')
                        <x-adminlte-input wire:model='nik' name="nik" placeholder="Masukan NIK Pasien"
                            igroup-size="lg">
                            <x-slot name="appendSlot">
                                <x-adminlte-button wire:click='cariPasien' theme="primary" label="Cari" />
                            </x-slot>
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    @else
                        <x-adminlte-input wire:model='nomorkartu' name="nomorkartu"
                            placeholder="Masukan Nomor BPJS Pasien" igroup-size="lg">
                            <x-slot name="appendSlot">
                                <x-adminlte-button wire:click='cariPasien' theme="primary" label="Cari" />
                            </x-slot>
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-primary">
                                    <i class="fas fa-user"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                    @endif
                    @if (count($rujukans) || count($suratkontrols) || count($rujukanrs))
                        @if (!$nomorreferensi)
                            <table class="table table-bordered table-sm">
                                <tr>
                                    <th>Surat Rujukan / Kontrol</th>
                                    <th>Nomor</th>
                                    <th>Tanggal</th>
                                    <th>Poliklinik</th>
                                    <th>FKTP</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach ($rujukans as $item)
                                    <tr>
                                        <th>Rujukan FKTP</th>
                                        <th>{{ $item->noKunjungan }}</th>
                                        <th>{{ $item->tglKunjungan }}</th>
                                        <th>{{ $item->poliRujukan->nama }}</th>
                                        <th>{{ $item->provPerujuk->nama }}</th>
                                        <th>Aktif</th>
                                        <th>
                                            <x-adminlte-button wire:click="pilihSurat('{{ $item->noKunjungan }}', '1')"
                                                label="Pilih" class="btn-sm" theme="success" />
                                        </th>
                                    </tr>
                                @endforeach
                                @foreach ($rujukanrs as $item)
                                    <tr>
                                        <th>Rujukan RS</th>
                                        <th>{{ $item->noKunjungan }}</th>
                                        <th>{{ $item->tglKunjungan }}</th>
                                        <th>{{ $item->poliRujukan->nama }}</th>
                                        <th>{{ $item->provPerujuk->nama }}</th>
                                        <th>Aktif</th>
                                        <th>
                                            <x-adminlte-button wire:click="pilihSurat('{{ $item->noKunjungan }}', '4')"
                                                label="Pilih" class="btn-sm" theme="success" />
                                        </th>
                                    </tr>
                                @endforeach
                                @foreach ($suratkontrols as $item)
                                    <tr>
                                        <th>Surat Kontrol</th>
                                        <th>{{ $item->noSuratKontrol }}</th>
                                        <th>{{ $item->tglRencanaKontrol }}</th>
                                        <th>{{ $item->namaPoliTujuan }}</th>
                                        <th>{{ $item->namaPoliAsal }}</th>
                                        <th>{{ $item->terbitSEP }} Dipakai</th>
                                        <th>
                                            <x-adminlte-button
                                                wire:click="pilihSurat('{{ $item->noSuratKontrol }}', '3')"
                                                label="Pilih" class="btn-sm" theme="success" />
                                        </th>
                                    </tr>
                                @endforeach
                            </table>
                            <br>
                        @endif
                        <x-adminlte-input wire:model='nomorreferensi' name="nomorreferensi"
                            placeholder="Nomor Rujukan / Surat Kontrol" igroup-size="lg">
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-primary">
                                    <i class="fas fa-file-medical"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input>
                        <x-adminlte-select wire:model.live='kodepoli' name="kodepoli" igroup-size="lg">
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-primary">
                                    <i class="fas fa-clinic-medical"></i>
                                </div>
                            </x-slot>
                            <option selected value="">Pilih Poliklinik</option>
                            @foreach ($polikliniks as $item)
                                <option value="{{ $item->kodesubspesialis }}">{{ $item->namasubspesialis }}</option>
                            @endforeach
                        </x-adminlte-select>
                        <x-adminlte-select wire:model.live='jadwaldokter' name="jadwaldokter" igroup-size="lg">
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-primary">
                                    <i class="fas fa-user-md"></i>
                                </div>
                            </x-slot>
                            <option selected value="">Pilih Jadwal Dokter</option>
                            @foreach ($jadwals as $item)
                                <option value="{{ $item->id }}">{{ $item->jampraktek }} {{ $item->namadokter }}
                                </option>
                            @endforeach
                        </x-adminlte-select>
                    @else
                        @if (!$nik || !$nomorkartu)
                            <x-adminlte-alert theme="warning" title="Silahkan isi data diatas !">
                                Silahkan masukan NIK atau Nomor Kartu BPJS terlebih dahulu.
                            </x-adminlte-alert>
                        @else
                            <x-adminlte-alert theme="danger" title="Mohon Maaf Peringatan !">
                                Pasien tidak memiliki Rujukan atau Surat Kontrol, silahkan dapat di bantu oleh Duta MJKN
                                untuk mengeceknya.
                            </x-adminlte-alert>
                        @endif

                    @endif
                    <x-slot name="footerSlot">
                        <a wire:navigate href="{{ route('anjunganantrian.index') }}">
                            <x-adminlte-button icon="fas fa-arrow-left" theme="danger" label="Kembali" />
                        </a>
                        @if ($jadwaldokter)
                            <x-adminlte-button wire:click='daftar' icon="fas fa-user-plus" theme="success"
                                label="Daftar" />
                        @endif
                    </x-slot>
                </x-adminlte-card>
            </div>
        @else
            <div class="col-md-12">
                <x-adminlte-card class="m-2" title="Pilih Jadwal Dokter {{ $jenispasien }}" theme="green"
                    icon="fas fa-user-md">
                    <div class="row">
                        @foreach ($jadwals as $item)
                            <div class="col-md-4 ">
                                <x-adminlte-info-box wire:click='ambilantrian({{ $item->id }})'
                                    title="{{ $item->namapoli }}" text="{{ $item->namadokter }}"
                                    description="{{ $item->jampraktek }}" theme="success" class="m-1"
                                    icon-theme="dark" />
                            </div>
                        @endforeach
                    </div>
                    <x-slot name="footerSlot">
                        <a wire:navigate href="{{ route('anjunganantrian.index') }}">
                            <x-adminlte-button icon="fas fa-arrow-left" theme="danger" label="Kembali" />
                        </a>
                    </x-slot>
                </x-adminlte-card>
            </div>
        @endif

    </div>
</div>
