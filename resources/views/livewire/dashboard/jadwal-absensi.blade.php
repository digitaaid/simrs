    <div>
        <div class="row">
            <div class="col-lg-3 col-12">
                @if ($absensi)
                    <x-adminlte-small-box title="{{ $absensi->status_absen ? $absensi->status_absen : 'Belum Absensi' }}"
                        text="Absensi {{ $absensi->jam_masuk }}-{{ $absensi->jam_pulang }} " theme="success"
                        icon="fas fa-user-check" url="{{ route('absensi.proses') }}" url-text="Proses Absensi" />
                @else
                    <x-adminlte-small-box title="Tidak Ada Jadwal" text="Absensi Hari Ini" theme="secondary"
                        icon="fas fa-user-times" url="{{ route('absensi.proses') }}" url-text="Proses Absensi" />
                @endif
            </div>
        </div>
        <x-adminlte-card title="Jadwal Kerja Pegawai" theme="secondary" icon="fas fa-calendar">
            <table class="table text-nowrap table-sm table-hover table-bordered table-responsive mb-3">
                <thead>
                    <tr>
                        <th>Bulan/Tanggal</th>
                        @foreach ($tanggals as $item)
                            <th class="text-center">{{ explode('-', $item)[2] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ now()->format('F') }}</td>
                        @foreach ($tanggals as $item)
                            <td>
                                @if ($this->user->shift_pegawai->where('tanggal', $item)->first())
                                    @php
                                        $jadwalx = $this->user->shift_pegawai->where('tanggal', $item)->first();
                                    @endphp
                                    <x-adminlte-button class="btn-xs" theme="warning"
                                        label="{{ explode(':', $jadwalx->jam_masuk)[0] }}-{{ explode(':', $jadwalx->jam_pulang)[0] }}" />
                                @else
                                    <x-adminlte-button class="btn-xs" theme="secondary" label="Libur" />
                                @endif
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </x-adminlte-card>
    </div>
