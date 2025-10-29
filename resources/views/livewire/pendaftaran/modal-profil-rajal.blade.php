<div class="row">
    <div class="col-md-3">
        <style>
            .table-xs,
            .table-xs td,
            .table-xs th {
                padding: 0px;
                margin-bottom: 0px !important;
                padding-right: 3px;
            }
        </style>
        <table class="table table-borderless table-xs table-responsive">
            <tr>
                <td>Antrian</td>
                <td>:</td>
                <td>
                    <b>{{ $antrian->nomorantrean ?? 'Belum didaftarakan' }} </b>
                    @if ($antrian)
                        <span class="badge badge-{{ $antrian->status ? 'success' : 'danger' }}"
                            title="{{ $antrian->status ? 'Sudah' : 'Belum' }} Integrasi">
                            {{ $antrian->kodebooking }}
                        </span>
                    @else
                        -
                    @endif

                </td>
            </tr>
            <tr>
                <td>Tgl Periksa</td>
                <td>:</td>
                <td>{{ $antrian->tanggalperiksa ?? 'Belum didaftarkan' }}</td>
            </tr>
            <tr>
                <td>Penjamin</td>
                <td>:</td>
                <td>{{ $antrian->jenispasien ?? 'Belum didaftarkan' }}</td>
            </tr>
            <tr>
                <td>Jenis Pasien</td>
                <td>:</td>
                @if ($antrian)
                    <td>{{ $antrian->pasienbaru ? 'Pasien Baru' : 'Pasien Lama' }}</td>
                @else
                    <td>Belum Didaftarkan</td>
                @endif
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <td>{{ $antrian->nohp ?? 'Belum didaftarkan' }}</td>
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-borderless table-xs table-responsive">
            <tr>
                <td>RM</td>
                <td>:</td>
                @if ($antrian)
                    <td>{{ $antrian->norm ? $antrian->norm : 'Belum Didaftarkan' }}</td>
                @else
                    <td>Belum Didaftarkan</td>
                @endif
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                @if ($antrian)
                    <td>{{ $antrian->nama ? $antrian->nama : 'Belum Didaftarkan' }}
                        {{ $antrian->kunjungan ? '(' . $antrian->kunjungan->gender . ')' : null }}
                    </td>
                @else
                    <td>Belum Didaftarkan</td>
                @endif

            </tr>
            <tr>
                <td class="text-nowrap">Tgl Lahir</td>
                <td>:</td>
                @if ($antrian)
                    <td>
                        @if ($antrian->kunjungan)
                            {{ $antrian->kunjungan->tgl_lahir ?? 'Belum didaftarkan' }}
                            ({{ \Carbon\Carbon::parse($antrian->kunjungan->tgl_masuk)->diffInYears($antrian->kunjungan->tgl_lahir) }}
                            tahun)
                        @else
                            Belum Kunjungan
                        @endif
                    </td>
                @else
                    <td>Belum Didaftarkan</td>
                @endif

            </tr>
            <tr>
                <td class="text-nowrap">NIK</td>
                <td>:</td>
                @if ($antrian)
                    <td>{{ $antrian->nik ? $antrian->nik : 'Belum Didaftarkan' }}</td>
                @else
                    <td>Belum Didaftarkan</td>
                @endif

            </tr>
            <tr>
                <td class="text-nowrap">Alamat</td>
                <td>:</td>
                @if ($antrian)
                    <td>{{ $antrian->pasien ? $antrian->pasien?->alamat : 'Belum Didaftarkan' }}
                    </td>
                @else
                    <td>Belum Didaftarkan</td>
                @endif
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-borderless table-xs table-responsive">
            <tr>
                <td class="col-sm-3 m-0">Kunjungan</td>
                <td>:</td>
                @if ($antrian)
                    <td>
                        <span class="badge badge-{{ $antrian->kodekunjungan ? 'success' : 'danger' }}"
                            title="{{ $antrian->kodekunjungan ? 'Sudah' : 'Belum' }} Integrasi">
                            {{ $antrian->kodekunjungan ? $antrian->kunjungan->counter . ' / ' . $antrian->kodekunjungan : 'Belum Kunjungan' }}
                        </span>
                    </td>
                @else
                    <td>Belum Didaftarkan</td>
                @endif

            </tr>
            <tr>
                <td class="col-sm-3 m-0">Status</td>
                <td>:</td>
                <td>
                    @if ($antrian)
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
                    @endif
                </td>
            </tr>
            <tr>
                <td class="col-sm-3 m-0">Jenis</td>
                <td>:</td>
                <td>
                    @if ($antrian)
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
                    @endif
                </td>
            </tr>
            <tr>
                <td class="col-sm-3 m-0">No Ref</td>
                <td>:</td>
                <td>
                    {{ $antrian->nomorreferensi ?? '-' }}
                </td>
            </tr>
            <tr>
                <td class="col-sm-3 m-0">SEP</td>
                <td>:</td>
                <td>
                    @if ($antrian)
                        @if ($antrian->sep)
                            {{ $antrian->sep }}
                        @else
                            -
                        @endif
                    @endif
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table class="table table-borderless table-xs table-responsive">
            <tr>
                <td>Pendaftaran</td>
                <td>:</td>
                <td>
                    @if ($antrian)
                        {{ $antrian->pic1 ? $antrian->pic1->name : 'Belum Didaftarkan' }}
                    @endif

                </td>
            </tr>
            <tr>
                <td>Unit</td>
                <td>:</td>
                <td>
                    @if ($antrian)
                        {{ $antrian->kunjungan ? $antrian->kunjungan->units->nama : 'Belum Kunjungan' }}
                    @endif

                </td>
            </tr>
            <tr>
                <td>Perawat</td>
                <td>:</td>
                <td>
                    @if ($antrian)
                        {{ $antrian->pic2 ? $antrian->pic2->name : 'Belum Asesmen' }}
                    @endif

                </td>
            </tr>
            <tr>
                <td>Dokter</td>
                <td>:</td>
                <td>
                    @if ($antrian)
                        {{ $antrian->namadokter ?? 'Belum Asesmen' }}
                    @endif

                </td>
            </tr>
            <tr>
                <td>Farmasi</td>
                <td>:</td>
                <td>
                    @if ($antrian)
                        {{ $antrian->pic4 ? $antrian->pic4->name : 'Belum Resep Obat' }}
                    @endif

                </td>
            </tr>
        </table>
        <dl class="row">

        </dl>
    </div>
</div>
