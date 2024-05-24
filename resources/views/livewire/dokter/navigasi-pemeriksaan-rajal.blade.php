<ul class="nav nav-pills flex-column">
    <li class="nav-item" wire:click='modalIcare'>
        <a href="#" class="nav-link">
            <i class="fas fa-file-medical"></i> I-Care JKN
        </a>
    </li>
    <li class="nav-item" onclick="tambahLayanan()">
        <a href="#" class="nav-link">
            <i class="fas fa-hand-holding-medical"></i> Layanan & Tindakan
            <span class="badge bg-success float-right">
                {{ $antrian->layanans->count() }} Layanan
            </span>
        </a>
    </li>
    <li class="nav-item" wire:click='modalCppt' >
        <a href="#" class="nav-link">
            <i class="fas fa-file-medical"></i> CPPT
            <span class="badge bg-success float-right">
                {{ $antrian->pasien ? $antrian->pasien->kunjungans->count() : 0 }} Kunjungan
            </span>
        </a>
    </li>
    <li class="nav-item" onclick="btnFileUplpad()">
        <a href="#" class="nav-link">
            <i class="fas fa-file-medical"></i> Berkas File Upload
            <span class="badge bg-success float-right">
                {{-- {{ $antrian->pasien ? $antrian->pasien->fileuploads->count() : 0 }} Berkas File --}}
            </span>
        </a>
    </li>
    <li class="nav-item" wire:click='modalAsesmenRajal'>
        <a href="#" class="nav-link">
            <i class="fas fa-file-medical-alt"></i> Asesmen Rawat Jalan
        </a>
    </li>
    <li class="nav-item" wire:click='modalPemeriksaanPerawat'>
        <a href="#" class="nav-link">
            <i class="fas fa-user-nurse"></i> Pemeriksaan Perawat
            @if ($antrian->asesmenrajal?->status_asesmen_perawat)
                <span class="badge bg-success float-right">
                    {{ $antrian->asesmenrajal?->pic_perawat }}
                </span>
            @else
                <span class="badge bg-danger float-right">Belum Asesmen</span>
            @endif
        </a>
    </li>
    <li class="nav-item" wire:click='modalPemeriksaanDokter'>
        <a href="#" class="nav-link">
            <i class="fas fa-user-md"></i> Pemeriksaan Dokter
            @if ($antrian->asesmenrajal?->status_asesmen_dokter)
                <span class="badge bg-success float-right">
                    {{ $antrian->asesmenrajal?->pic_dokter }}
                </span>
            @else
                <span class="badge bg-danger float-right">Belum Asesmen</span>
            @endif
        </a>
    </li>
    <li class="nav-item" wire:click='modalResumeRajal'>
        <a href="#" class="nav-link">
            <i class="fas fa-file-medical-alt"></i> Resume Rawat Jalan
        </a>
    </li>
</ul>


