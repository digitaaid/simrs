<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#datapasien" class="nav-link">
                    <i class="fas fa-users"></i> Data Pasien
                    <span class="badge bg-success float-right">Pasien</span>
                </a>
                <a href="#triaseigd" class="nav-link">
                    <i class="fas fa-ambulance"></i> Triase & Anamnesis
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#anamnesis" class="nav-link">
                    <i class="fas fa-user-md"></i> Asesmen Awal
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Diagnosis Klinis
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
                <a href="#identitaspasien" class="nav-link">
                    <i class="fas fa-users"></i> Instruksi Tindak Lanjut
                    {{-- <span class="badge bg-success float-right"></span> --}}
                </a>
            </li>
        </ul>
        <x-slot name="footerSlot">
            <a href="{{ route('pendaftaran.igd') }}?tanggalperiksa={{ $antrian->tanggalperiksa ?? now()->format('Y-m-d') }}">
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
