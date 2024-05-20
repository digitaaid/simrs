<div class="row">
    @if (flash()->message)
        <div class="col-md-12">
            <x-adminlte-alert theme="{{ flash()->class }}" title="{{ flash()->class }} !" dismissable>
                {{ flash()->message }}
            </x-adminlte-alert>
        </div>
    @endif

    <div class="col-md-12">
        <x-adminlte-card title="Table Referensi Dokter" theme="secondary">
            <div class="row">
                <div class="col-md-3">
                    <div wire:ignore>
                        <x-adminlte-select2 wire:model="kodepoli" name="kodepoli" igroup-size="sm">
                            @forelse ($polikliniks as $item)
                                <option value="{{ $item->kdpoli }}">{{ $item->nmsubspesialis }}</option>
                            @empty
                            @endforelse
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-primary">
                                    <i class="fas fa-clinic-medical"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-select2>
                    </div>
                </div>
                <div class="col-md-3">
                    @php
                        $config = ['format' => 'YYYY-MM-DD'];
                    @endphp
                    <x-adminlte-input-date wire:model="tanggal" name="tanggalperiksa"
                        value="{{ now()->format('Y-m-d') }}" placeholder="Pilih Tanggal" igroup-size="sm"
                        :config="$config">
                        <x-slot name="prependSlot">
                            <div class="input-group-text text-primary">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </x-slot>
                        <x-slot name="appendSlot">
                            <x-adminlte-button class="btn-sm" wire:click='cari' onclick="cari()" type="submit"
                                theme="primary" label="Cari" />
                        </x-slot>
                    </x-adminlte-input-date>
                </div>
                <div class="col-md-6">
                </div>
            </div>
            <div wire:loading class="col-md-12">
                <div class="row">
                    <p class="card-text placeholder-glow col-6"></p>
                    <p class="card-text placeholder-glow col-7"></p>
                    <p class="card-text placeholder-glow col-4"></p>
                    <p class="card-text placeholder-glow col-4"></p>
                    <p class="card-text placeholder-glow col-6"></p>
                    <p class="card-text placeholder-glow col-8"></p>
                    <br>
                </div>
                <style>
                    .placeholder {
                        display: inline-block;
                        width: 100%;
                        height: 1em;
                        background-color: #e9ecef;
                        border-radius: 0.2rem;
                    }

                    .placeholder-glow::before {
                        content: "\00a0";
                        display: inline-block;
                        width: 100%;
                        height: 100%;
                        background-color: #e9ecef;
                        border-radius: inherit;
                        animation: glow 1.5s infinite linear;
                    }

                    @keyframes glow {
                        0% {
                            opacity: 1;
                        }

                        50% {
                            opacity: 0.4;
                        }

                        100% {
                            opacity: 1;
                        }
                    }
                </style>
            </div>
            <div wire:loading.remove>
                <table class="table text-nowrap table-sm table-hover table-bordered table-responsive-xl mb-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Dokter</th>
                            <th>Kode Dokter</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->namasubspesialis }}</td>
                                <td>{{ $item->namadokter }}</td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-adminlte-card>
    </div>
</div>
@push('js')
    <script>
        function cari() {
            @this.set('tanggal', $('#tanggalperiksa').val());
            @this.set('kodepoli', $('#kodepoli').val());
            console.log($('#kodepoli').val());
            console.log($('#tanggalperiksa').val());
        }
    </script>
@endpush
