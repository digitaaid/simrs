<div class="row">
    <div class="col-md-3">
        <table>
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
        </table>
    </div>
    <div class="col-md-3">
        <table>
            <tr>
                <td>RM</td>
                <td>:</td>
                <th>{{ $kunjungan->norm ?? 'Belum Didaftarkan' }}</th>
            </tr>
            <tr>
                <td>Nama</td>
                <td>:</td>
                <th>{{ $kunjungan->pasien?->nama ?? 'Belum Didaftarkan' }} ({{ $kunjungan->pasien?->gender ?? '' }})
                </th>
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
                    @if ($kunjungan->pasien)
                    ({{ \Carbon\Carbon::parse($kunjungan->pasien?->tgl_lahir)->age  }} tahun)
                    @endif
                </th>
            </tr>
        </table>
    </div>
</div>
