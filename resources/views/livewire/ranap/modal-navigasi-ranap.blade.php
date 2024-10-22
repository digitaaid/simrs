<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#datapasien" class="nav-link">
                    <i class="fas fa-users"></i> Data Pasien
                    @if ($kunjungan)
                        <span class="badge bg-success float-right">{{ $kunjungan->nama }}</span>
                    @else
                        <span class="badge bg-danger float-right">Belum Daftar</span>
                    @endif
                </a>
                <a href="#kunjunganigd" class="nav-link">
                    <i class="fas fa-ambulance"></i> Kunjungan
                    @if ($kunjungan)
                        @switch($kunjungan->status)
                            @case(1)
                                <span class="badge bg-warning float-right">{{ $kunjungan->status }}. Aktif
                                </span>
                            @break

                            @case(2)
                                <span class="badge bg-success float-right">{{ $kunjungan->status }}. Selesai
                                </span>
                            @break

                            @case(99)
                                <span class="badge bg-success float-right">{{ $kunjungan->status }}. Batal
                                </span>
                            @break

                            @default
                        @endswitch
                    @else
                        <span class="badge bg-danger float-right">0. Belum Daftar</span>
                    @endif
                </a>
                @if ($kunjungan)
                    <a href="#suratkontrol" class="nav-link">
                        <i class="fas fa-file-medical"></i> Surat Kontrol & SPRI
                        {{-- <span class="badge bg-success float-right"></span> --}}
                    </a>
                    <a href="#modalsep" class="nav-link">
                        <i class="fas fa-file-medical"></i> SEP
                        @if ($kunjungan->sep)
                            <span class="badge bg-success float-right">{{ $kunjungan->sep }}</span>
                        @endif
                    </a>
                    <a href="#cpptranap" class="nav-link">
                        <i class="fas fa-file-medical"></i> CPPT Pasien Ranap
                        <span class="badge bg-success float-right">{{ $kunjungan->cppt_ranap->count() }} Catatan
                        </span>
                    </a>
                    {{-- <a href="#triaseigd" class="nav-link">
                        <i class="fas fa-ambulance"></i> Triase & Anamnesis
                    </a>
                    <a href="#anamnesis" class="nav-link">
                        <i class="fas fa-user-md"></i> Asesmen Awal
                    </a>
                    <a href="#identitaspasien" class="nav-link">
                        <i class="fas fa-users"></i> Diagnosis Klinis
                    </a> --}}
                    <a href="#layanan" class="nav-link">
                        <i class="fas fa-hand-holding-medical"></i> Layanan & Tindakan
                        @if ($kunjungan->layanans)
                            <span
                                class="badge bg-success float-right">{{ money($kunjungan->layanans->sum('subtotal'), 'IDR') }}
                            </span>
                        @else
                            <span class="badge bg-success float-right">{{ money(0, 'IDR') }}
                            </span>
                        @endif
                    </a>
                    <a href="#resepdokterigd" class="nav-link">
                        <i class="fas fa-pills"></i> Resep Obat
                        @if ($kunjungan->resepfarmasidetails)
                            <span
                                class="badge bg-success float-right">{{ money($kunjungan->resepfarmasidetails->sum('subtotal'), 'IDR') }}
                            </span>
                        @else
                            <span class="badge bg-success float-right">{{ money(0, 'IDR') }}
                            </span>
                        @endif
                    </a>
                    <a href="#resumeranap" class="nav-link">
                        <i class="fas fa-file-medical"></i> Resume Rawat Inap
                        @if ($kunjungan->resume_ranap)
                            <span class="badge bg-success float-right">Sudah</span>
                        @else
                            <span class="badge bg-danger float-right">Belum</span>
                        @endif
                    </a>
                    <a href="#invoiceigd" class="nav-link">
                        <i class="fas fa-file-medical"></i> Invoice Rawat Inap
                        @if ($kunjungan->resepfarmasidetails || $kunjungan->layanans)
                            <span
                                class="badge bg-success float-right">{{ money($kunjungan->layanans?->sum('subtotal') + $kunjungan->resepfarmasidetails?->sum('subtotal'), 'IDR') }}
                            </span>
                        @else
                            <span class="badge bg-success float-right">{{ money(0, 'IDR') }}
                            </span>
                        @endif
                    </a>
                    <a href="#pemulanganranap" class="nav-link">
                        <i class="fas fa-bed"></i> Pemulangan Pasien
                        @if ($kunjungan->tgl_pulang)
                            <span class="badge bg-success float-right">{{ $kunjungan->tgl_pulang }}</span>
                        @else
                            <span class="badge bg-warning float-right">Belum Pulang</span>
                        @endif
                    </a>
                @endif
            </li>
        </ul>
        <x-slot name="footerSlot">
            <a
                href="{{ route('pendaftaran.ranap') }}?tanggalperiksa={{ $antrian->tanggalperiksa ?? now()->format('Y-m-d') }}">
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
