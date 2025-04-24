<div>
    <x-adminlte-card theme="primary" title="General Comsent" icon="fas fa-file">
        <div class="row">
            <div class="col-md-4 mb-2">
                <h6>General Consent</h6>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->nama }}</td>
                    </tr>
                    <tr>
                        <td>No RM</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->norm }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->tgl_lahir }}</td>
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
                </table>
            </div>
            <div class="col-md-4 mb-2">
                <h6>Persetujaun Pasien</h6>
                <table>
                    <tr>
                        <td>Informasi Ketentuan Pembayaran</td>
                        <td>:</td>
                        <td>Ya/Tidak</td>
                    </tr>
                    <tr>
                        <td>Informasi tentang Hak dan Kewajiban Pasien</td>
                        <td>:</td>
                        <td>Ya/Tidak</td>
                    </tr>
                    <tr>
                        <td>Informasi tentang Tata Tertib RS</td>
                        <td>:</td>
                        <td>Ya/Tidak</td>
                    </tr>
                    <tr>
                        <td>Kebutuhan Penterjemah Bahasa</td>
                        <td>:</td>
                        <td>Ya/Tidak</td>
                    </tr>
                    <tr>
                        <td>Kebutuhan Rohaniawan</td>
                        <td>:</td>
                        <td>Ya/Tidak</td>
                    </tr>
                    <tr>
                        <td>
                            Pelepasan Informasi / Kerahasiaan Informasi
                            <ol>
                                <li>Hasil Pemeriksaan Penunjang dapat Diberikan kepada Pihak Penjamin</li>
                                <li>Hasil Pemeriksaan Penunjang dapat Diakses oleh Peserta Didik</li>
                                <li>Anggota Keluarga Lain yang dapat Diberikan Informasi Data data Pasien</li>
                                <li>Fasyankes tertentu dalam rangka rujukan </li>
                            </ol>
                        </td>
                        <td>:</td>
                        <td>Ya/Tidak</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-4 mb-2">
                <h6>Yang Membuat Pernyataan</h6>
                <table>
                    <tr>
                        <td>Penanggung Jawab</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Petugas</td>
                        <td>:</td>
                        <td>{{ $kunjungan->pasien->agama ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button theme="success" icon="fas fa-print" class="btn-sm" label="Print"
                wire:click="editKunjungan" wire:confirm='Apakah anda yakin akan print data ?' />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary">
                </div>
                Loading ...
            </div>
            @if (flash()->message)
                <div class="text-{{ flash()->class }}" wire:loading.remove>
                    Loading Result : {{ flash()->message }}
                </div>
            @endif
        </x-slot>
    </x-adminlte-card>
</div>
