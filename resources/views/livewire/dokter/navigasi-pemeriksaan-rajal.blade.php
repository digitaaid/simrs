<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
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
            <li class="nav-item" onclick="modalCPPT()">
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
                        {{ $antrian->pasien ? $antrian->pasien->fileuploads->count() : 0 }} Berkas File
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
                    @if ($antrian->asesmenperawat)
                        <span class="badge bg-success float-right">
                            {{ $antrian->asesmenperawat->pic ?? null }}
                        </span>
                    @else
                        <span class="badge bg-danger float-right">Belum Asesmen</span>
                    @endif
                </a>
            </li>
            <li class="nav-item" wire:click='modalPemeriksaanDokter'>
                <a href="#" class="nav-link">
                    <i class="fas fa-user-md"></i> Pemeriksaan Dokter
                    @if ($antrian->asesmendokter)
                        <span class="badge bg-success float-right">
                            {{ $antrian->asesmendokter->pic->name ?? null }}
                        </span>
                    @else
                        <span class="badge bg-danger float-right">Belum Pemeriksaan</span>
                    @endif
                </a>
            </li>
            <li class="nav-item" wire:click='modalResumeRajal'>
                <a href="#" class="nav-link">
                    <i class="fas fa-file-medical-alt"></i> Resume Rawat Jalan
                </a>
            </li>
        </ul>
        <x-slot name="footerSlot">
            <a href="{{ route('pemeriksaan.perawat.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}">
                <x-adminlte-button class="btn-xs" label="Selesai & Kembali" theme="success" icon="fas fa-arrow-left" />
            </a>
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
