<ul class="nav nav-pills flex-column">
    <li class="nav-item">
        <a href="#icare" class="nav-link">
            <i class="fas fa-file-medical"></i> I-Care JKN
        </a>
    </li>
    <li class="nav-item">
        <a href="#cppt" class="nav-link">
            <i class="fas fa-file-medical"></i> CPPT
            <span class="badge bg-success float-right">
                {{ $antrian->pasien ? $antrian->pasien->kunjungans->count() : 0 }} Kunjungan
            </span>
        </a>
    </li>
    <li class="nav-item">
        <a href="#laboratorium" class="nav-link">
            <i class="fas fa-file-medical"></i> Laboratorium
            {{-- <span class="badge bg-success float-right"></span> --}}
        </a>
    </li>
    <li class="nav-item">
        <a href="#radiologi" class="nav-link">
            <i class="fas fa-file-medical"></i> Radiologi
            {{-- <span class="badge bg-success float-right"></span> --}}
        </a>
    </li>
    <li class="nav-item">
        <a href="#penunjang" class="nav-link">
            <i class="fas fa-file-medical"></i> Penunjang Lainnya
            {{-- <span class="badge bg-success float-right"></span> --}}
        </a>
    </li>
    <li class="nav-item">
        <a href="#layanan" class="nav-link">
            <i class="fas fa-hand-holding-medical"></i> Layanan & Tindakan
            <span class="badge bg-success float-right">
                {{ $antrian->kunjungan?->layanans->count() }} Layanan
            </span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a href="#asesmenrajal" class="nav-link">
            <i class="fas fa-file-medical-alt"></i> Asesmen Rawat Jalan
        </a>
    </li> --}}
    @can('perawat')
        <li class="nav-item">
            <a href="#pemeriksaanperawat" class="nav-link">
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
    @endcan
    @can('dokter')
        <li class="nav-item">
            <a href="#pemeriksaandokter" class="nav-link">
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
    @endcan
    <li class="nav-item">
        <a href="#resumerajal" class="nav-link">
            <i class="fas fa-file-medical-alt"></i> Resume Rawat Jalan
        </a>
    </li>
</ul>
