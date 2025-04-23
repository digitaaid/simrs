<div class="wrapper">
    <div class="row p-1">
        <div class="col-md-12">
            <div class="card">
                <header class="bg-{{ config('adminlte.anjungan_color') }} text-white p-2">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <img src="{{ asset(config('adminlte.logo_img')) }}" width="80">
                                    <div class="col">
                                        <h2>Anjungan Antrian</h2>
                                        <h4>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h1>{{ config('adminlte.title') }}</h1>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Formulir Antrian Mandiri" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-user-injured">
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
                    <x-adminlte-input wire:model='nik' name="nik" placeholder="Masukan NIK Pasien" igroup-size="lg">
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
                    <x-adminlte-input wire:model='nomorkartu' name="nomorkartu" placeholder="Masukan Nomor BPJS Pasien"
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
                @endif
                @if ($keyInput)
                    <div class="btn-group mb-3" role="group" aria-label="Basic example">
                        @for ($i = 0; $i <= 9; $i++)
                            <button type="button" class="btn btn-lg btn-secondary mr-1"
                                wire:click="addDigit('{{ $i }}')">{{ $i }}</button>
                        @endfor
                        <button type="button" class="btn btn-danger btn-lg" wire:click="deleteDigit()">Hapus</button>
                    </div>
                @endif
                @if (count($rujukans) || count($suratkontrols) || count($rujukanrs))
                    @if (!$nomorreferensi)
                        @foreach ($rujukans as $item)
                            <a href="#"
                                wire:click="pilihSurat('{{ $item->noKunjungan }}', '1', '{{ $item->poliRujukan->kode }}')">
                                <x-adminlte-card class="mb-2 withLoad" body-class="bg-warning">
                                    <h5>SURAT RUJUKAN Klinik {{ $item->poliRujukan->nama }} </h5>
                                    Asal Rujukan {{ $item->provPerujuk->nama }}
                                    Nomor Rujukan :{{ $item->noKunjungan }}
                                    Tanggal Rujukan {{ $item->tglKunjungan }}
                                </x-adminlte-card>
                            </a>
                        @endforeach
                        @foreach ($rujukanrs as $item)
                            <a href="#"
                                wire:click="pilihSurat('{{ $item->noKunjungan }}', '4', '{{ $item->poliRujukan->kode }}')">
                                <x-adminlte-card class="mb-2 withLoad" body-class="bg-warning">
                                    <h5>SURAT RUJUKAN POLIKLINIK {{ $item->poliRujukan->nama }} </h5>
                                    Asal Rujukan {{ $item->provPerujuk->nama }}
                                    Nomor Rujukan :{{ $item->noKunjungan }}
                                    Tanggal Rujukan {{ $item->tglKunjungan }}
                                </x-adminlte-card>
                            </a>
                        @endforeach
                        @foreach ($suratkontrols as $item)
                            <a href="#"
                                wire:click="pilihSurat('{{ $item->noSuratKontrol }}', '3','{{ $item->poliTujuan }}')">
                                <x-adminlte-card class="mb-2 withLoad" body-class="bg-warning">
                                    <h5>SURAT KONTROL POLIKLINIK {{ $item->namaPoliTujuan }} </h5>
                                    Tgl Kontrol {{ $item->tglRencanaKontrol }}
                                    Nomor Surat Kontrol {{ $item->noSuratKontrol }}
                                    {{ $item->terbitSEP }} Dipakai
                                </x-adminlte-card>
                            </a>
                        @endforeach
                        <br>
                    @endif
                    <x-adminlte-input wire:model='nomorreferensi' name="nomorreferensi"
                        placeholder="Nomor Rujukan / Surat Kontrol" igroup-size="lg" readonly>
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-file-medical"></i>
                            </div>
                        </x-slot>
                    </x-adminlte-input>
                    <x-adminlte-select wire:model.live='kodepoli' name="kodepoli" igroup-size="lg">
                        <x-slot name="prependSlot" readonly>
                            <div class="input-group-text text-primary">
                                <i class="fas fa-clinic-medical"></i>
                            </div>
                        </x-slot>
                        <option selected value="">--Pilih Poliklinik--</option>
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
                    <div wire:loading>
                        Loading...
                    </div>
                </x-slot>
            </x-adminlte-card>
        </div>
        <div class="col-md-6">
            <x-adminlte-card title="Anjungan Checkin Antrian" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-qrcode">
                <div class="text-center">
                    <img src="{{ asset('bpjs/qrantrian.png') }}" width="48%" alt="">
                    <img src="{{ asset('bpjs/bpjs2.jpg') }}" width="45%" alt="">
                    <br>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
