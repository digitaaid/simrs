@switch($antrian->taskid)
    @case(0)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Belum Checkin" theme="danger" />
    @break

    @case(1)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Tunggu Pendaftaran" theme="warning" />
    @break

    @case(2)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Proses Pendaftaran" theme="primary" />
    @break

    @case(3)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Tunggu Poliklinik" theme="warning" />
    @break

    @case(4)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Pemeriksaan Dokter" theme="primary" />
    @break

    @case(5)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Tunggu Farmasi" theme="warning" />
    @break

    @case(6)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Proses Racik Obat" theme="primary" />
    @break

    @case(7)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Selesai" theme="success" />
    @break

    @case(99)
        <x-adminlte-button class="btn-xs" label="{{ $antrian->taskid }}. Batal" theme="danger" />
    @break

    @default
@endswitch
<div class="row">
    <div class="col-md-4">
        <dl class="row">
            <dt class="col-sm-3 m-0">Antrian</dt>
            <dd class="col-sm-9 m-0">
                <span class="badge badge-{{ $antrian->status ? 'success' : 'danger' }}"
                    title="{{ $antrian->status ? 'Sudah' : 'Belum' }} Integrasi">
                    {{ $antrian->nomorantrean }} / {{ $antrian->kodebooking }}
                </span>
            </dd>
            <dt class="col-sm-3 m-0">Tgl Periksa</dt>
            <dd class="col-sm-9 m-0">{{ $antrian->tanggalperiksa }}</dd>
            <dt class="col-sm-3 m-0">RM</dt>
            <dd class="col-sm-9 m-0">{{ $antrian->norm ? $antrian->norm : 'Belum Didaftarkan' }} </dd>
            <dt class="col-sm-3 m-0">Nama</dt>
            <dd class="col-sm-9 m-0">{{ $antrian->nama ? $antrian->nama : 'Belum Didaftarkan' }}
                {{ $antrian->kunjungan ? '(' . $antrian->kunjungan->gender . ')' : null }}
            </dd>
            <dt class="col-sm-3 m-0"> Tgl Lahir</dt>
            <dd class="col-sm-9 m-0">
                @if ($antrian->kunjungan)
                    {{ $antrian->kunjungan->tgl_lahir ?? 'Belum didaftarkan' }}
                    ({{ \Carbon\Carbon::parse($antrian->kunjungan->tgl_masuk)->diffInYears($antrian->kunjungan->tgl_lahir) }}
                    tahun)
                @else
                    Belum Kunjungan
                @endif
            </dd>
        </dl>
    </div>
    <div class="col-md-3">
        <dl class="row">
            <dt class="col-sm-3 m-0">Kunjgn</dt>
            <dd class="col-sm-9 m-0">
                <span class="badge badge-{{ $antrian->kodekunjungan ? 'success' : 'danger' }}"
                    title="{{ $antrian->kodekunjungan ? 'Sudah' : 'Belum' }} Integrasi">
                    {{ $antrian->kodekunjungan ? $antrian->kunjungan->counter . ' / ' . $antrian->kodekunjungan : 'Belum Kunjungan' }}
                </span>
            </dd>
            <dt class="col-sm-3 m-0">Jenis</dt>
            <dd class="col-sm-9 m-0">
                @switch($antrian->jeniskunjungan)
                    @case(1)
                        Rujukan FKTP
                    @break

                    @case(2)
                        Umum
                    @break

                    @case(3)
                        Surat Kontrol
                    @break

                    @case(4)
                        Rujukan Antar RS
                    @break

                    @default
                        Belum Kunjungan
                @endswitch
            </dd>
            <dt class="col-sm-3 m-0">Status</dt>
            <dd class="col-sm-9 m-0">
                @switch($antrian->taskid)
                    @case(0)
                        Belum Checkin
                    @break

                    @case(1)
                        Tunggu Pendaftaran
                    @break

                    @case(2)
                        Proses Pendaftaran
                    @break

                    @case(3)
                        Tunggu Poliklinik
                    @break

                    @case(4)
                        Pemeriksaan Dokter
                    @break

                    @case(5)
                        Tunggu Farmasi
                    @break

                    @case(6)
                        Proses Farmasi
                    @break

                    @case(7)
                        Selesai Pelayanan
                    @break

                    @case(99)
                        <span class="badge badge-danger">Batal</span>
                    @break

                    @default
                @endswitch
            </dd>
            <dt class="col-sm-3 m-0">No Ref</dt>
            <dd class="col-sm-9 m-0">
                {{ $antrian->nomorreferensi ?? '-' }}
            </dd>
            <dt class="col-sm-3 m-0">SEP</dt>
            <dd class="col-sm-9 m-0">
                @if ($antrian->sep)
                    {{ $antrian->sep }}
                @else
                    -
                @endif
            </dd>
        </dl>
    </div>
    <div class="col-md-5">
        <dl class="row">
            <dt class="col-sm-3 m-0">Pendaftaran</dt>
            <dd class="col-sm-9 m-0">
                {{ $antrian->pic1 ? $antrian->pic1->name : 'Belum Didaftarkan' }}
            </dd>
            {{-- <dt class="col-sm-3 m-0">Diagnosa SEP</dt>
            <dd class="col-sm-8 m-09>
                {{ $antrian->kunjungan->diagnosa_awal ?? '-' }}
            </dd> --}}
            <dt class="col-sm-3 m-0">Unit</dt>
            <dd class="col-sm-9 m-0">
                {{ $antrian->kunjungan ? $antrian->kunjungan->units->nama : 'Belum Kunjungan' }}
            </dd>
            <dt class="col-sm-3 m-0">Perawat</dt>
            <dd class="col-sm-9 m-0">
                {{ $antrian->pic2 ? $antrian->pic2->name : 'Belum Asesmen Perawat' }}
            </dd>
            <dt class="col-sm-3 m-0">Dokter</dt>
            <dd class="col-sm-9 m-0">
                {{ $antrian->kunjungan ? $antrian->kunjungan->dokters->nama : 'Belum Kunjungan' }}
            </dd>
            <dt class="col-sm-3 m-0">Farmasi</dt>
            <dd class="col-sm-9 m-0">
                {{ $antrian->pic4 ? $antrian->pic4->name : 'Belum Ada Resep Obat' }}
            </dd>
        </dl>
    </div>
</div>
