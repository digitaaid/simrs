<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#datapasien" class="nav-link">
                    <i class="fas fa-users"></i> Data Pasien
                    @if ($kunjungan->nama)
                        <span class="badge bg-success float-right">{{ $kunjungan->nama }}</span>
                    @else
                        <span class="badge bg-danger float-right">Belum Daftar</span>
                    @endif
                </a>
                <a href="#kunjunganigd" class="nav-link">
                    <i class="fas fa-ambulance"></i> Kunjungan
                    @if ($kunjungan->tgl_masuk)
                        <span class="badge bg-success float-right">{{ $kunjungan->tgl_masuk }}</span>
                    @else
                        <span class="badge bg-danger float-right">Belum Daftar</span>
                    @endif
                </a>
                @if ($kunjungan)
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
                        {{-- <span class="badge bg-success float-right"></span> --}}
                    </a>
                    <a href="#resepdokterigd" class="nav-link">
                        <i class="fas fa-pills"></i> Resep Obat
                        {{-- <span class="badge bg-success float-right"></span> --}}
                        @if ($kunjungan->resepobatdetails)
                            <span class="badge bg-success float-right">{{ count($kunjungan->resepobatdetails) }}
                                Obat</span>
                        @endif
                    </a>
                    <a href="#instruksitindaklanjut" class="nav-link">
                        <i class="fas fa-users"></i> Instruksi Tindak Lanjut
                        {{-- <span class="badge bg-success float-right"></span> --}}
                    </a>
                    <a href="#tranferrawatinap" class="nav-link">
                        <i class="fas fa-bed"></i> Transfer Rawat Inap
                        @if ($kunjungan->kode_transfer)
                            <span class="badge bg-success float-right">Sudah ditransfer</span>
                        @endif
                    </a>
                    <a href="#tranferrawatinap" class="nav-link">
                        <i class="fas fa-ambulance"></i> Pemulangan Pasien IGD
                        @if ($kunjungan->tgl_pulang)
                            <span class="badge bg-success float-right">{{ $kunjungan->tgl_pulang }}</span>
                        @endif
                    </a>
                    <a href="#resumeigd" class="nav-link">
                        <i class="fas fa-file-medical"></i> Resume IGD
                        {{-- <span class="badge bg-success float-right"></span> --}}
                    </a>
                    <a href="#invoiceigd" class="nav-link">
                        <i class="fas fa-file-medical"></i> Invoice IGD
                        {{-- <span class="badge bg-success float-right"></span> --}}
                    </a>
                @endif
            </li>
        </ul>
        <x-slot name="footerSlot">
            <a
                href="{{ route('pendaftaran.igd') }}?tanggalperiksa={{ $antrian->tanggalperiksa ?? now()->format('Y-m-d') }}">
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
