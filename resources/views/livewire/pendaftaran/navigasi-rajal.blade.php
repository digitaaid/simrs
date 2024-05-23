<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#" wire:click='formPasien' class="nav-link">
                    <i class="fas fa-users"></i> Data Pasien
                    <span class="badge bg-success float-right">{{ $pasiencount }} Pasien</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" wire:click='formAntrian' onclick="formAntrian()" class="nav-link">
                    <i class="fas fa-user-plus"></i> Antrian
                    @if ($antrian->status)
                        <span class="badge bg-success float-right">Sudah Didaftarkan</span>
                    @else
                        <span class="badge bg-danger float-right">Belum Didaftarkan</span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a href="#" wire:click='formKunjungan' class="nav-link">
                    <i class="fas fa-user-plus"></i> Kunjungan
                    @if ($antrian->kunjungan)
                        <span class="badge bg-success float-right">Sudah Didaftarkan</span>
                    @else
                        <span class="badge bg-danger float-right">Belum Kunjungan</span>
                    @endif
                </a>
            </li>
            @if ($antrian->jenispasien == 'JKN')
                <li class="nav-item" onclick="cariSEP()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-medical"></i> SEP
                        @if ($antrian->sep)
                            <span class="badge bg-success float-right">Sudah Dibuatkan</span>
                        @else
                            <span class="badge bg-danger float-right">Belum Dibuatkan</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item" onclick="cariSuratKontrol()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-medical"></i> Surat Kontrol
                        {{-- @if ($antrian->suratkontrols->count())
                            <span class="badge bg-success float-right">Sudah Ada SKontrol Berikutnya</span>
                        @else
                            <span class="badge bg-danger float-right">Belum Ada SKontrol Berikutnya</span>
                        @endif --}}
                    </a>
                </li>
                <li class="nav-item" onclick="cariRujukanFktp()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-medical"></i> Rujukan FKTP
                    </a>
                </li>
                <li class="nav-item" onclick="cariRujukanRS()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-medical"></i> Rujukan Antar RS
                    </a>
                </li>
            @endif
            @if ($antrian->kunjungan)
                <li class="nav-item" onclick="modalCPPT()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-medical"></i> CPPT
                        <span class="badge bg-success float-right">
                            {{ $antrian->pasien ? $antrian->pasien->kunjungans->where('status', 1)->count() : 0 }}
                            Kunjungan
                        </span>
                    </a>
                </li>
                <li class="nav-item" onclick="btnFileUplpad()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-medical"></i> Berkas File Upload
                        <span class="badge bg-success float-right">
                            {{ $antrian->pasien ? $antrian->pasien->fileuploads->count() : 0 }} Berkas File
                        </span>
                    </a>
                </li>
                <li class="nav-item" onclick="tambahLayanan()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-hand-holding-medical"></i> Layanan & Tindakan
                        <span class="badge bg-success float-right">
                            {{ $antrian->layanans->count() }} Layanan
                        </span>
                    </a>
                </li>
                <li class="nav-item" onclick="modalInvoicePasien()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-invoice-dollar"></i> Invoice Billing
                    </a>
                </li>
                {{-- <li class="nav-item" onclick="modalPasien()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-vials"></i> Laboratorium
                    </a>
                </li>
                <li class="nav-item" onclick="modalPasien()">
                    <a href="#nav" class="nav-link">
                        <i class="fas fa-file-invoice-dollar"></i> Kasir & Keuangan
                    </a>
                </li> --}}
            @endif
        </ul>
        <x-slot name="footerSlot">
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
            {{-- @if ($antrian?->kunjungan?->status)
                <x-adminlte-button label="Selesai Pendaftaran" class="btn-sm" icon="fas fa-check" theme="success"
                    onclick="modalPendaftaranSelesai()" />
            @endif
            <a href="{{ route('batalantrian') }}?kodebooking={{ $antrian->kodebooking }}&keterangan=Dibatalkan dipendaftaran {{ Auth::user()->name }}"
                class="btn btn-sm btn-danger withLoad">
                <i class="fas fa-times"></i> Batal
            </a> --}}
        </x-slot>
    </x-adminlte-card>
</div>