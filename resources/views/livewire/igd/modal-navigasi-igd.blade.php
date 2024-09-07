<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#datapasien" class="nav-link">
                    <i class="fas fa-users"></i> Data Pasien
                    <span class="badge bg-success float-right">Pasien</span>
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Identitas Pasien
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Cara Pembayaran
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> General Consent
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Triase & Gawat Darurat
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Asesmen Awal IGD
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Screening IGD
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Laboratorium
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Radiologi
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Penunjang Lainnya
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Tindakan & Layanan
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Resep Obat Farmasi
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
            </li>
        </ul>
        <x-slot name="footerSlot">
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
