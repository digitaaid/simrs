<div class="row">
    <div class="col-md-12">
        <x-adminlte-card theme="primary" theme-mode="outline">
            <a wire:navigate href="{{ route('pendaftaran.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}">
                <x-adminlte-button class="btn-xs" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
            </a>
            <x-adminlte-button class="btn-xs" label="Panggil Pendaftaran" theme="primary" icon="fas fa-volume" />
            @include('livewire.pendaftaran.pendaftaran-rajal-profil')
        </x-adminlte-card>
    </div>
    <div class="col-md-3">
        <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#" wire:click='dataPasien' class="nav-link">
                        <i class="fas fa-users"></i> Data Pasien
                        <span class="badge bg-success float-right">{{ $pasiencount }} Pasien</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" wire:click='formAntrian' class="nav-link">
                        <i class="fas fa-user-plus"></i> Antrian
                        @if ($antrian->status)
                            <span class="badge bg-success float-right">Sudah Didaftarkan</span>
                        @else
                            <span class="badge bg-danger float-right">Belum Didaftarkan</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" wire:click='formKunjungan' class="nav-link">
                        <i class="fas fa-user-plus"></i> Kunjungan
                        @if ($antrian->kunjungan)
                            <span class="badge bg-success float-right">Sudah Didaftarkan</span>
                        @else
                            <span class="badge bg-danger float-right">Belum Kunjungan</span>
                        @endif
                    </a>
                </li>
                @if ($antrian->jenispasien == 'JKN')
                    <li class="nav-item" onclick="cariSEP()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-medical"></i> SEP
                            @if ($antrian->sep)
                                <span class="badge bg-success float-right">Sudah Dibuatkan</span>
                            @else
                                <span class="badge bg-danger float-right">Belum Dibuatkan</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" onclick="cariSuratKontrol()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-medical"></i> Surat Kontrol
                            @if ($antrian->suratkontrols->count())
                                <span class="badge bg-success float-right">Sudah Ada SKontrol Berikutnya</span>
                            @else
                                <span class="badge bg-danger float-right">Belum Ada SKontrol Berikutnya</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item" onclick="cariRujukanFktp()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-medical"></i> Rujukan FKTP
                        </a>
                    </li>
                    <li class="nav-item" onclick="cariRujukanRS()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-medical"></i> Rujukan Antar RS
                        </a>
                    </li>
                @endif
                @if ($antrian->kunjungan)
                    <li class="nav-item" onclick="modalCPPT()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-medical"></i> CPPT
                            <span class="badge bg-success float-right">
                                {{ $antrian->pasien ? $antrian->pasien->kunjungans->where('status', 1)->count() : 0 }}
                                Kunjungan
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" onclick="btnFileUplpad()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-medical"></i> Berkas File Upload
                            <span class="badge bg-success float-right">
                                {{ $antrian->pasien ? $antrian->pasien->fileuploads->count() : 0 }} Berkas File
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" onclick="tambahLayanan()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-hand-holding-medical"></i> Layanan & Tindakan
                            <span class="badge bg-success float-right">
                                {{ $antrian->layanans->count() }} Layanan
                            </span>
                        </a>
                    </li>
                    <li class="nav-item" onclick="modalInvoicePasien()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-invoice-dollar"></i> Invoice Billing
                        </a>
                    </li>
                    {{-- <li class="nav-item" onclick="modalPasien()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-vials"></i> Laboratorium
                        </a>
                    </li>
                    <li class="nav-item" onclick="modalPasien()">
                        <a href="#nav" class="nav-link">
                            <i class="fas fa-file-invoice-dollar"></i> Kasir & Keuangan
                        </a>
                    </li> --}}
                @endif
            </ul>
            <x-slot name="footerSlot">
                {{-- @if ($antrian?->kunjungan?->status)
                    <x-adminlte-button label="Selesai Pendaftaran" class="btn-sm" icon="fas fa-check" theme="success"
                        onclick="modalPendaftaranSelesai()" />
                @endif
                <a href="{{ route('batalantrian') }}?kodebooking={{ $antrian->kodebooking }}&keterangan=Dibatalkan dipendaftaran {{ Auth::user()->name }}"
                    class="btn btn-sm btn-danger withLoad">
                    <i class="fas fa-times"></i> Batal
                </a> --}}
            </x-slot>
        </x-adminlte-card>

    </div>
    <div class="col-md-9">
        @if ($openformAntrian)
            <x-adminlte-card  theme="primary" title="Antrian Pasien">
                <form wire:submit="editAntrian">
                    <input type="hidden" wire:model='kodebooking' name="kodebooking"
                        value="{{ $antrian->kodebooking }}">
                    <input type="hidden" wire:model='antrianId' name="antrianId" value="{{ $antrian->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input wire:model='nomorkartu' name="nomorkartu" class="nomorkartu-antrian"
                                fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" label="Nomor Kartu" value="{{ $antrian->nomorkartu }}"
                                enable-old-support placeholder="Nomor Kartu">
                                <x-slot name="appendSlot">
                                    <div class="btn btn-primary" onclick="btnCariKartu()">
                                        <i class="fas fa-search"></i> Cari
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="nik" class="nik-id" enable-old-support fgroup-class="row"
                                label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" label="NIK"
                                placeholder="NIK" value="{{ $antrian->nik }}">
                                <x-slot name="appendSlot">
                                    <div class="btn btn-primary" onclick="btnCariNIK()">
                                        <i class="fas fa-search"></i> Cari
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="norm" class="norm-id" label="No RM" fgroup-class="row"
                                label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                                placeholder="No RM" value="{{ $antrian->norm }}" enable-old-support>
                                <x-slot name="appendSlot">
                                    <div class="btn btn-primary" onclick="btnCariRM()">
                                        <i class="fas fa-search"></i> Cari
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="nama" class="nama-id" label="Nama Pasien" fgroup-class="row"
                                label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                                placeholder="Nama Pasien" value="{{ $antrian->nama }}" enable-old-support />
                            <x-adminlte-input name="nohp" class="nohp-id" label="Nomor HP" fgroup-class="row"
                                label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                                placeholder="Nomor HP" value="{{ $antrian->nohp }}" enable-old-support />
                        </div>
                        <div class="col-md-6">
                            @php
                                $config = ['format' => 'YYYY-MM-DD'];
                            @endphp
                            <x-adminlte-input-date name="tanggalperiksa" class="tanggalperiksa-id" fgroup-class="row"
                                label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                                label="Tanggal Periksa" value="{{ $antrian->tanggalperiksa }}"
                                placeholder="Tanggal Periksa" :config="$config" enable-old-support>
                            </x-adminlte-input-date>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="jenispasien" label="Jenis Pasien" enable-old-support>
                                <option selected disabled>Pilih Jenis Pasien</option>
                                <option value="JKN" {{ $antrian->jenispasien == 'JKN' ? 'selected' : null }}>JKN
                                </option>
                                <option value="NON-JKN" {{ $antrian->jenispasien == 'NON-JKN' ? 'selected' : null }}>
                                    NON-JKN
                                </option>
                            </x-adminlte-select>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="kodepoli" label="Poliklinik" enable-old-support>
                                @foreach ($polikliniks as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ $value }}</option>
                                @endforeach
                            </x-adminlte-select>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="kodedokter" label="Dokter" enable-old-support>
                                @foreach ($dokters as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </x-adminlte-select>
                            @if ($antrian->jenispasien == 'JKN')
                                <x-adminlte-select fgroup-class="row" label-class="text-left col-3"
                                    igroup-class="col-9" igroup-size="sm" name="asalRujukan"
                                    class="asalRujukan-antrian" label="Jenis Rujukan" enable-old-support>
                                    <option value="1" {{ $antrian->jeniskunjungan == '1' ? 'selected' : null }}>
                                        Rujukan
                                        FKTP</option>
                                    <option value="2" {{ $antrian->jeniskunjungan == '4' ? 'selected' : null }}>
                                        Rujukan
                                        Antar RS</option>
                                </x-adminlte-select>
                                <x-adminlte-input name="noRujukan" class="noRujukan-id" fgroup-class="row"
                                    label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                                    label="No Rujukan" placeholder="No Rujukan" enable-old-support readonly
                                    value="{{ $antrian->nomorrujukan }}">
                                    <x-slot name="appendSlot">
                                        <div class="btn btn-primary" onclick="cariRujukanAntrian()">
                                            <i class="fas fa-search"></i> Cari
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                                <x-adminlte-input name="noSurat" class="noSurat-id" fgroup-class="row"
                                    label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                                    label="No Surat Kontrol" placeholder="No Surat Kontrol"
                                    value="{{ $antrian->nomorsuratkontrol }}" enable-old-support readonly>
                                    <x-slot name="appendSlot">
                                        <div class="btn btn-primary" onclick="cariSuratKontrol()">
                                            <i class="fas fa-search"></i> Cari
                                        </div>
                                    </x-slot>
                                </x-adminlte-input>
                            @endif
                        </div>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                        type="submit" wire:click="editAntrian" />
                    <x-adminlte-button wire:click='closeformAntrian' theme="danger" class="btn-sm"
                        icon="fas fa-times" label="Tutup" />
                </x-slot>
            </x-adminlte-card>
        @endif
        @if ($openformKunjungan)
            <x-adminlte-card theme="primary" title="Kunjungan Pasien">
                <form >
                    <input type="hidden" name="kodebooking" value="{{ $antrian->kodebooking }}">
                    <input type="hidden" name="antrian_id" value="{{ $antrian->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <x-adminlte-input name="nomorkartu" class="nomorkartu-id" enable-old-support
                                fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" label="Nomor Kartu" value="{{ $antrian->nomorkartu }}"
                                placeholder="Nomor Kartu">
                                <x-slot name="appendSlot">
                                    <div class="btn btn-primary" onclick="btnCariKartu()">
                                        <i class="fas fa-search"></i> Cari
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="nik" class="nik-id" enable-old-support fgroup-class="row"
                                label-class="text-left col-3" igroup-class="col-9" igroup-size="sm" label="NIK"
                                placeholder="NIK" value="{{ $antrian->nik }}">
                                <x-slot name="appendSlot">
                                    <div class="btn btn-primary" onclick="btnCariNIK()">
                                        <i class="fas fa-search"></i> Cari
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="norm" class="norm-id" label="No RM" enable-old-support
                                fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" placeholder="No RM" value="{{ $antrian->norm }}">
                                <x-slot name="appendSlot">
                                    <div class="btn btn-primary" onclick="btnCariRM()">
                                        <i class="fas fa-search"></i> Cari
                                    </div>
                                </x-slot>
                            </x-adminlte-input>
                            <x-adminlte-input name="nama" class="nama-id" label="Nama Pasien" enable-old-support
                                fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" placeholder="Nama Pasien" value="{{ $antrian->nama }}" />
                            <x-adminlte-input name="tgl_lahir" class="tgllahir-id" enable-old-support
                                label="Tanggal Lahir" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" value="{{ $antrian->kunjungan->tgl_lahir ?? null }}"
                                igroup-size="sm" placeholder="Tanggal Lahir" />
                            <x-adminlte-input name="gender" class="gender-id" enable-old-support
                                label="Jenis Kelamin" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" value="{{ $antrian->kunjungan->gender ?? null }}"
                                igroup-size="sm" placeholder="Jenis Kelamin" />
                            <x-adminlte-input name="kelas" enable-old-support
                                value="{{ $antrian->kunjungan->kelas ?? null }}" class="kelas-id"
                                label="Kelas Pasien" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" igroup-size="sm" placeholder="Kelas Pasien" />
                            <x-adminlte-input name="penjamin" class="penjamin-id" enable-old-support label="Penjamin"
                                fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" placeholder="Penjamin"
                                value="{{ $antrian->kunjungan->penjamin ?? null }}" />
                        </div>
                        <div class="col-md-6">
                            <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                name="kodekunjungan" label="Kode Kunjungan" igroup-size="sm"
                                placeholder="Kode Kunjungan" readonly value="{{ $antrian->kunjungan->kode ?? null }}"
                                enable-old-support />
                            <x-adminlte-input fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                name="counter" label="Counter" igroup-size="sm" placeholder="Counter Kunjungan"
                                value="{{ $antrian->kunjungan->counter ?? null }}" enable-old-support readonly />
                            @php
                                $config = ['format' => 'YYYY-MM-DD HH:mm:ss'];
                            @endphp
                            <x-adminlte-input-date fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" name="tgl_masuk" igroup-size="sm" label="Tanggal Masuk"
                                enable-old-support placeholder="Tanggal Masuk" :config="$config"
                                value="{{ $antrian->kunjungan->tgl_masuk ?? now() }}">
                            </x-adminlte-input-date>
                            <x-adminlte-select igroup-size="sm" fgroup-class="row" label-class="text-left col-3"
                                igroup-class="col-9" name="jaminan" label="Jaminan Pasien" enable-old-support>
                                <option selected disabled>Pilih Jaminan</option>
                                {{-- @foreach ($jaminans as $key => $item)
                                    <option value="{{ $key }}"
                                        {{ $antrian->kunjungan ? ($antrian->kunjungan->jaminan == $key ? 'selected' : null) : null }}>
                                        {{ $item }}
                                    </option>
                                @endforeach --}}
                            </x-adminlte-select>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="kodepoli" label="Poliklinik" enable-old-support>
                                @foreach ($polikliniks as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ $antrian->kunjungan ? ($antrian->kunjungan->unit == $key ? 'selected' : null) : null }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="kodedokter" label="Dokter" enable-old-support>
                                @foreach ($dokters as $key => $value)
                                    <option value="{{ $key }}"
                                        {{ $antrian->kunjungan ? ($antrian->kunjungan->dokter == $key ? 'selected' : null) : null }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </x-adminlte-select>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="cara_masuk" label="Cara Masuk" enable-old-support>
                                <option selected disabled>Pilih Cara Masuk</option>
                                <option value="gp"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'gp' ? 'selected' : null) : null }}>
                                    Rujukan
                                    FKTP</option>
                                <option value="hosp-trans"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'hosp-trans' ? 'selected' : null) : null }}>
                                    Rujukan FKRTL</option>
                                <option value="mp"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'mp' ? 'selected' : null) : null }}>
                                    Rujukan
                                    Spesialis</option>
                                <option value="outp"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'outp' ? 'selected' : null) : null }}>
                                    Dari
                                    Rawat Jalan</option>
                                <option value="inp"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'inp' ? 'selected' : null) : null }}>
                                    Dari
                                    Rawat Inap</option>
                                <option value="emd"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'emd' ? 'selected' : null) : null }}>
                                    Dari
                                    Rawat Darurat</option>
                                <option value="born"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'born' ? 'selected' : null) : null }}>
                                    Lahir
                                    di RS</option>
                                <option value="nursing"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'nursing' ? 'selected' : null) : null }}>
                                    Rujukan Panti Jompo</option>
                                <option value="psych"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'psych' ? 'selected' : null) : null }}>
                                    Rujukan dari RS Jiwa</option>
                                <option value="rehab"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'rehab' ? 'selected' : null) : null }}>
                                    Rujukan Fasilitas Rehab</option>
                                <option value="other"
                                    {{ $antrian->kunjungan ? ($antrian->kunjungan->cara_masuk == 'other' ? 'selected' : null) : null }}>
                                    Lain-lain</option>
                            </x-adminlte-select>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="diagnosa_awal" enable-old-support class="diagnosaid2"
                                label="Diagnosa Awal">
                                @if ($antrian->kunjungan)
                                    <option value="{{ $antrian->kunjungan->diagnosa_awal }}">
                                        {{ $antrian->kunjungan->diagnosa_awal }}
                                    </option>
                                @endif
                            </x-adminlte-select>
                            <x-adminlte-select fgroup-class="row" label-class="text-left col-3" igroup-class="col-9"
                                igroup-size="sm" name="jeniskunjungan" enable-old-support label="Jenis Kunjungan">
                                <option selected disabled>Pilih Jenis Rujukan</option>
                                <option value="1" {{ $antrian->jeniskunjungan == '1' ? 'selected' : null }}>
                                    Rujukan FKTP</option>
                                <option value="2" {{ $antrian->jeniskunjungan == '2' ? 'selected' : null }}>
                                    Umum</option>
                                <option value="3" {{ $antrian->jeniskunjungan == '3' ? 'selected' : null }}>
                                    Kontrol</option>
                                <option value="4" {{ $antrian->jeniskunjungan == '4' ? 'selected' : null }}>
                                    Rujukan Antar RS</option>
                            </x-adminlte-select>
                            @if ($antrian->jeniskunjungan != 2)
                                <x-adminlte-input name="nomorreferensi" fgroup-class="row"
                                    label-class="text-left col-3" igroup-class="col-9" igroup-size="sm"
                                    enable-old-support label="Nomor Referensi" placeholder="Nomor Referensi"
                                    value="{{ $antrian->kunjungan->nomorreferensi ?? null }}" />
                                <x-adminlte-input name="sep" fgroup-class="row" label-class="text-left col-3"
                                    igroup-class="col-9" igroup-size="sm" label="Nomor SEP" enable-old-support
                                    placeholder="Nomor SEP" value="{{ $antrian->kunjungan->sep ?? null }}" />
                            @endif
                        </div>
                    </div>
                </form>
                <x-slot name="footerSlot">
                    <x-adminlte-button theme="success" icon="fas fa-save" class="btn-sm" label="Simpan"
                        type="submit" wire:click="editKunjungan" />
                    <x-adminlte-button wire:click='closeformKunjungan' theme="danger" class="btn-sm"
                        icon="fas fa-times" label="Tutup" />
                </x-slot>
            </x-adminlte-card>
        @endif

    </div>

</div>
