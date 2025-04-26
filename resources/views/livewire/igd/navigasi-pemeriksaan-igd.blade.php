<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#identitas" class="nav-link">
                    <i class="fas fa-user-injured"></i> Identitas Pasien
                </a>
                <a href="#generalconsent" class="nav-link">
                    <i class="fas fa-file"></i> General Consent
                </a>
                <a href="#triaseigd" class="nav-link">
                    <i class="fas fa-ambulance"></i> Triase Gawat Darurat
                </a>
                <a href="#asesmenigd" class="nav-link">
                    <i class="fas fa-file-medical"></i> Asesmen Awal IGD
                </a>
                <a href="#riwayatobat" class="nav-link">
                    <i class="fas fa-pills"></i> Riwayat Pengunaan Obat
                </a>
                <a href="#soap" class="nav-link">
                    <i class="fas fa-notes-medical"></i> SOAP
                </a>
                <a href="#layanan" class="nav-link">
                    <i class="fas fa-hand-holding-medical"></i> Layanan & Tindakan
                </a>
                <a href="#resepobat" class="nav-link">
                    <i class="fas fa-prescription-bottle-alt"></i> Resep Obat
                </a>
            </li>
        </ul>
        <x-slot name="footerSlot">
            <a
                href="{{ route('keperawatan.igd') }}?tanggal={{ \Carbon\Carbon::parse($kunjungan->tgl_masuk)->format('Y-m-d') }}">
                <x-adminlte-button class="btn-xs mb-1" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
            </a>
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
