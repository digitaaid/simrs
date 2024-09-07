<div class="row">
    {{-- profile --}}
    <div class="col-md-12">
        @if (flash()->message)
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        @endif
        <x-adminlte-card theme="primary" theme-mode="outline">
            @include('livewire.pendaftaran.modal-profil-rajal')
        </x-adminlte-card>
    </div>
    {{-- navigasi --}}
    <div class="col-md-3">
        <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-info-circle"></i> Status Antrian
                        @switch($antrian->taskid)
                            @case(0)
                                <span class="badge bg-secondary float-right">{{ $antrian->taskid }}. Belum Checkin</span>
                            @break

                            @case(1)
                                <span class="badge bg-warning float-right">{{ $antrian->taskid }}. Tunggu Pendaftaran</span>
                            @break

                            @case(2)
                                <span class="badge bg-primary float-right">{{ $antrian->taskid }}. Proses Pendaftaran</span>
                            @break

                            @case(3)
                                <span class="badge bg-warning float-right">{{ $antrian->taskid }}. Tunggu Dokter</span>
                            @break

                            @case(4)
                                <span class="badge bg-primary float-right">{{ $antrian->taskid }}. Pelayanan Dokter</span>
                            @break

                            @case(5)
                                <span class="badge bg-warning float-right">{{ $antrian->taskid }}. Tunggu Farmasi</span>
                            @break

                            @case(6)
                                <span class="badge bg-primary float-right">{{ $antrian->taskid }}. Pelayanan Farmasi</span>
                            @break

                            @case(7)
                                <span class="badge bg-success float-right">{{ $antrian->taskid }}. Selesai</span>
                            @break

                            @case(99)
                                <span class="badge bg-danger float-right">{{ $antrian->taskid }}. Batal</span>
                            @break

                            @default
                        @endswitch
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#datapasien" class="nav-link">
                        <i class="fas fa-users"></i> Data Pasien
                        <span class="badge bg-success float-right">{{ $pasiencount }} Pasien</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#antrian" class="nav-link">
                        <i class="fas fa-user-plus"></i> Antrian
                        @if ($antrian->status)
                            <span class="badge bg-success float-right">Sudah Didaftarkan</span>
                        @else
                            <span class="badge bg-danger float-right">Belum Didaftarkan</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#kunjungan" class="nav-link">
                        <i class="fas fa-user-plus"></i> Kunjungan
                        @if ($antrian->kunjungan)
                            <span class="badge bg-success float-right">Sudah Didaftarkan</span>
                        @else
                            <span class="badge bg-danger float-right">Belum Kunjungan</span>
                        @endif
                    </a>
                </li>
                @if ($antrian->jenispasien == 'JKN')
                    <li class="nav-item">
                        <a href="#modalsep" class="nav-link">
                            <i class="fas fa-file-medical"></i> SEP
                            @if ($antrian->sep)
                                <span class="badge bg-success float-right">Sudah Dibuatkan</span>
                            @else
                                <span class="badge bg-danger float-right">Belum Dibuatkan</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#suratkontrol" class="nav-link">
                            <i class="fas fa-file-medical"></i> Surat Kontrol
                            {{-- @if ($antrian->suratkontrols->count())
                                <span class="badge bg-success float-right">Sudah Ada SKontrol Berikutnya</span>
                            @else
                                <span class="badge bg-danger float-right">Belum Ada SKontrol Berikutnya</span>
                            @endif --}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#rujukanfktp" class="nav-link">
                            <i class="fas fa-file-medical"></i> Rujukan FKTP
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#rujukanrs" class="nav-link">
                            <i class="fas fa-file-medical"></i> Rujukan Antar RS
                        </a>
                    </li>
                @endif
                @if ($antrian->kunjungan)
                    <li class="nav-item">
                        <a href="#cppt" class="nav-link">
                            <i class="fas fa-file-medical"></i> CPPT
                            <span class="badge bg-success float-right">
                                {{ $antrian->pasien ? $antrian->pasien->kunjungans->count() : 0 }} Kunjungan
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#layanan" class="nav-link">
                            <i class="fas fa-hand-holding-medical"></i> Layanan & Tindakan
                            <span class="badge bg-success float-right">
                                {{ $antrian->layanans->count() }} Layanan
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#notaPembayaran" class="nav-link">
                            <i class="fas fa-file-invoice-dollar"></i> Nota Pembayaran
                        </a>
                    </li>
                @endif
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
            <x-slot name="footerSlot">
                <a href="{{ route('rekammedis.rajal') }}?tanggalperiksa={{ $antrian->tanggalperiksa }}">
                    <x-adminlte-button class="btn-xs mb-1" label="Kembali" theme="danger"
                        icon="fas fa-arrow-left" />
                </a>
                @if ($antrian->taskid == 1 || $antrian->taskid == 2)
                    <x-adminlte-button wire:click='panggilPendaftaran' class="btn-xs mb-1"
                        label="Panggil Pendaftaran" theme="primary" icon="fas fa-microphone" />
                @endif
                @if ($antrian->taskid == 2)
                    @if ($antrian?->kunjungan?->status)
                        <x-adminlte-button wire:click='selesaiPendaftaran'
                            wire:confirm='Apakah anda yakin antrian ini telah selesai ?' label="Selesai Pendaftaran"
                            class="btn-xs mb-1" icon="fas fa-check" theme="success" />
                    @endif
                @endif
                <x-adminlte-button wire:click='batal'
                    wire:confirm='Apakah anda yakin ingin membatalkan antrian dan kunjungan ini ?' label="Batal"
                    class="btn-xs mb-1" icon="fas fa-times" theme="danger" />
                {{-- <a href="{{ route('batalantrian') }}?kodebooking={{ $antrian->kodebooking }}&keterangan=Dibatalkan dipendaftaran {{ Auth::user()->name }}"
                    class="btn btn-sm btn-danger withLoad">
                    <i class="fas fa-times"></i> Batal
                </a> --}}
                <div wire:loading>
                    <div class="spinner-border spinner-border-sm text-primary" role="status">
                    </div>
                    Loading ...
                </div>
            </x-slot>
        </x-adminlte-card>
    </div>


    {{-- form --}}
    <div class="col-md-9" style="overflow-y: auto ;max-height: 600px ;">
        @livewire('pendaftaran.modal-pasien-rajal')
        @livewire('pendaftaran.modal-antrian-rajal', ['antrian' => $antrian])
        @livewire('pendaftaran.modal-kunjungan-rajal', ['antrian' => $antrian])
        @if ($antrian->pasien && $antrian->jenispasien == 'JKN')
            @livewire('pendaftaran.modal-sep', ['antrian' => $antrian])
            @livewire('pendaftaran.modal-suratkontrol', ['antrian' => $antrian])
        @endif
        @if ($antrian->kunjungan)
            @livewire('dokter.modal-cppt', ['antrian' => $antrian])
            @livewire('laboratorium.modal-laboratorium', ['antrian' => $antrian])
            @livewire('radiologi.modal-radiologi', ['antrian' => $antrian])
            @livewire('penunjang.modal-penunjang', ['antrian' => $antrian])
            @livewire('perawat.modal-layanan-tindakan', ['antrian' => $antrian])
            <div id="notaPembayaran">
                <x-adminlte-card theme="primary" title="Nota Pembayaran Pasien">
                    <iframe src="{{ route('print.notarajal', $antrian->kodebooking) }}" width="100%"
                        height="500" frameborder="0"></iframe>
                </x-adminlte-card>
            </div>
        @endif

        @livewire('dokter.modal-icare', ['antrian' => $antrian])
        @livewire('dokter.modal-cppt', ['antrian' => $antrian])
        {{-- @livewire('dokter.modal-asesmen-rajal') --}}
        @livewire('perawat.modal-perawat-rajal', ['antrian' => $antrian])
        @livewire('dokter.modal-dokter-rajal', ['antrian' => $antrian])
        @livewire('dokter.modal-resume-rajal', ['antrian' => $antrian])
    </div>
</div>
