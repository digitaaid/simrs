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
                    </a>
                    <a href="#modalsep" class="nav-link">
                        <i class="fas fa-file-medical"></i> SEP
                        @if ($kunjungan->sep)
                            <span class="badge bg-success float-right">{{ $kunjungan->sep }}</span>
                        @endif
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
                    </a>
                    <a href="#invoiceigd" class="nav-link">
                        <i class="fas fa-file-medical"></i> Invoice IGD
                        @if ($kunjungan->resepfarmasidetails || $kunjungan->layanans)
                            <span
                                class="badge bg-success float-right">{{ money($kunjungan->layanans?->sum('subtotal') + $kunjungan->resepfarmasidetails?->sum('subtotal'), 'IDR') }}
                            </span>
                        @else
                            <span class="badge bg-success float-right">{{ money(0, 'IDR') }}
                            </span>
                        @endif
                    </a>
                @endif
            </li>
        </ul>
        <x-slot name="footerSlot">
            <a
                href="{{ route('pendaftaran.igd') }}?tanggalperiksa={{ $antrian->tanggalperiksa ?? now()->format('Y-m-d') }}">
                <x-adminlte-button class="btn-xs mb-1" label="Kembali" theme="danger" icon="fas fa-arrow-left" />
            </a>
            <x-adminlte-button wire:click='batal'
                wire:confirm='Apakah anda yakin ingin membatalkan antrian dan kunjungan ini ?' label="Batal"
                class="btn-xs mb-1" icon="fas fa-times" theme="danger" />
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
