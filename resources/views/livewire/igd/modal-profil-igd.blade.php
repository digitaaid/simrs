<div class="row">
    <div class="col-md-3">
        <table>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <th>{{ $kunjungan->pasien?->nama ?? 'Belum Didaftarkan' }} ({{ $kunjungan->pasien?->gender ?? '' }})
                </th>
            </tr>
            <tr>
                <td>RM</td>
                <td>:</td>
                <th>{{ $kunjungan->norm ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>No BPJS</td>
                <td>:</td>
                <th>{{ $kunjungan->pasien?->nomorkartu ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>No HP</td>
                <td>:</td>
                <th>{{ $kunjungan->pasien?->nohp ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>Tgl Lahir</td>
                <td>:</td>
                <th>{{ $kunjungan->pasien?->tgl_lahir ?? 'Belum Didaftarkan' }}
                    @if ($kunjungan)
                        ({{ \Carbon\Carbon::parse($kunjungan->pasien?->tgl_lahir)->age }} tahun)
                    @endif
                </th>
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table>
            <tr>
                <td>Counter</td>
                <td>:</td>
                <th>{{ $kunjungan->counter ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>Tgl Masuk</td>
                <td>:</td>
                <th>{{ $kunjungan->tgl_masuk ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>Tgl Pulang</td>
                <td>:</td>
                <th>{{ $kunjungan->tgl_pulang ?? '-' }}</th>
            </tr>
            <tr>
                <td>Jaminan</td>
                <td>:</td>
                <th>{{ $kunjungan->tgl_pulang ?? '-' }}</th>
            </tr>
        </table>
    </div>
    <div class="col-md-3">
        <table>
            <tr>
                <td>Pendaftaran</td>
                <td>:</td>
                <th>{{ $kunjungan->pic1?->name ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>Perawat</td>
                <td>:</td>
                <th>{{ $kunjungan->pic2?->name ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>Dokter</td>
                <td>:</td>
                <th>{{ $kunjungan->pic3->name ?? 'Belum Didaftarkan' }}</th>
            </tr>
        </table>
    </div>
</div>
