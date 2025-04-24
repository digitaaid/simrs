<div>
    <x-adminlte-card theme="primary" title="Identitas Pasien" icon="fas fa-user-injured">
        <div class="row">
            <div class="col-md-4 mb-2">
                <h6>Identitas Pasien</h6>
                <table>
                    <tr>
                        <td>Nama Lengkap</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->nama }}</td>
                    </tr>
                    <tr>
                        <td>No RM</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->norm }}</td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->nik }}</td>
                    </tr>
                    <tr>
                        <td>Kartu BPJS</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->nomorkartu }}</td>
                    </tr>
                    <tr>
                        <td>Kelamin</td>
                        <td>:</td>
                        <td>
                            @if ($kunjungan->pasien->gender == 'L')
                                Laki-laki
                            @else
                                Perempuan
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Tempat Lahir</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->tgl_lahir }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-md-4 mb-2">
                <h6>Alamat & Kontak</h6>
                <table>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->alamat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>No HP</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->nohp ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->nohp ?? '-' }}</td>
                    </tr>

                </table>
            </div>
            <div class="col-md-4 mb-2">
                <h6>Soscial & Ekonomi</h6>
                <table>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Suku</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Bahasa</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pendidikan</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Status Pernikahan</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 mb-2">
                <h6>Keluarga / Wali</h6>
                <table>
                    <tr>
                        <td>Nama Ayah</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ibu</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Pengantar</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Penanggung Jawab</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 mb-2">
                <h6>Kepesertaan BPJS</h6>
                <table>
                    <tr>
                        <td>Nomor Kartu</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 mb-2">
                <h6>Pembayaran</h6>
                <table>
                    <tr>
                        <td>Penjamin</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-print" class="btn-sm" label="Print" wire:click="editKunjungan"
                wire:confirm='Apakah anda yakin akan print data ?' />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
