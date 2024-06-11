@extends('adminlte::print')
@section('title', 'Print Asesmen Resep Obat')
@section('content_header')
    <h1>Print Asesmen Resep Obat</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="printMe">
                <section class="invoice p-3 mb-1">
                    <div class="row">
                        @include('form.assesmen_kop')
                        <div class="col-md-8  border border-dark">
                            <dl>
                                <dt>Resep Obat :</dt>
                                @if ($antrian->resepobat)
                                    Kode Resep : {{ $antrian->resepobat->kode }} <br>
                                    Waktu : {{ $antrian->resepobat->waktu }} <br>
                                    @if ($antrian->resepobat)
                                        @foreach ($antrian->resepobat->resepdetail as $itemobat)
                                            <b> R/ {{ $itemobat->nama }} </b> ({{ $itemobat->jumlah }}) <br>
                                            &emsp;&emsp;
                                            @switch($itemobat->interval)
                                                @case('qod')
                                                    1x1
                                                @break

                                                @case('dod')
                                                    1x2
                                                @break

                                                @case('bid')
                                                    2x1
                                                @break

                                                @case('tid')
                                                    3x1
                                                @break

                                                @case('qid')
                                                    4x1
                                                @break

                                                @case('prn')
                                                    SESUAI KEBUTUHAN
                                                @break

                                                @case('q3h')
                                                    SETIAP 3 JAM
                                                @break

                                                @case('q4h')
                                                    SETIAP 4 JAM
                                                @break

                                                @case('303')
                                                    3 TAB/CAP SETIAP PAGI DAN MALAM
                                                @break

                                                @case('202')
                                                    2 TAB/CAP SETIAP PAGI DAN MALAM
                                                @break

                                                @default
                                            @endswitch


                                            @switch($itemobat->waktu)
                                                @case('pc')
                                                    SETELAH MAKAN
                                                @break

                                                @case('ac')
                                                    SEBELUM MAKAN
                                                @break

                                                @case('hs')
                                                    SEBELUM TIDUR
                                                @break

                                                @case('int')
                                                    DIANTARA WAKTU MAKAN
                                                @break

                                                @default
                                            @endswitch


                                            {{ $itemobat->keterangan }} <br>
                                        @endforeach
                                    @endif
                                @endif

                                <dd>
                                    <pre id="resepobat">{{ $antrian->asesmendokter->resep_obat ?? null }}</pre>
                                </dd>
                                <dt>Catatan Resep :</dt>
                                <dd>
                                    <pre>{{ $antrian->asesmendokter->catatan_resep ?? null }}</pre>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-md-4 border border-dark" style="font-size: 10px">
                            <div class="row">
                                <div class="col-md-12 border border-dark">
                                    <b>Barat Badan</b> : {{ $antrian->asesmenperawat->berat_badan ?? '-' }} kg<br>
                                    <b>Tgl</b> : {{ $antrian->asesmendokter->waktu ?? '-' }}<br>
                                    <b>Unit</b> : {{ $antrian->namapoli ?? '-' }}<br>
                                    <b>Dokter :</b> : {{ $antrian->namadokter ?? '-' }}<br>
                                    <b>Riwayat Alergi Obat :</b> :
                                    {{ $antrian->asesmenperawat->riwayat_alergi ?? null }}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 border border-dark"><b>Telaah Administratif</b></div>
                                <div class="col-md-2 border border-dark">Ya</div>
                                <div class="col-md-2 border border-dark">Tidak</div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">1</div>
                                <div class="col-md-7 border border-dark">Nama Pasien</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">2</div>
                                <div class="col-md-7 border border-dark">Umur Pasien</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">3</div>
                                <div class="col-md-7 border border-dark">Jenis Kelamin & BB/TB</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">4</div>
                                <div class="col-md-7 border border-dark">Paraf & Cap Dokter</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">5</div>
                                <div class="col-md-7 border border-dark">Tgl Resep</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">6</div>
                                <div class="col-md-7 border border-dark">Asal Poli</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 border border-dark"><b>Telaah Farmasetik</b></div>
                                <div class="col-md-2 border border-dark">Ya</div>
                                <div class="col-md-2 border border-dark">Tidak</div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">1</div>
                                <div class="col-md-7 border border-dark">Nama Obat</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">2</div>
                                <div class="col-md-7 border border-dark">Bentuk Sediaan</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">3</div>
                                <div class="col-md-7 border border-dark">Kekuatan Sediaan</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">4</div>
                                <div class="col-md-7 border border-dark">Dosis & Jumlah Obat</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">5</div>
                                <div class="col-md-7 border border-dark">Aturan & Cara</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 border border-dark"><b>Telaah Klinis</b></div>
                                <div class="col-md-2 border border-dark">Ya</div>
                                <div class="col-md-2 border border-dark">Tidak</div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">1</div>
                                <div class="col-md-7 border border-dark">Indikasi</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">2</div>
                                <div class="col-md-7 border border-dark">Dosis</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">3</div>
                                <div class="col-md-7 border border-dark">Waktu Penggunaan</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">4</div>
                                <div class="col-md-7 border border-dark">Duplikasi</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">5</div>
                                <div class="col-md-7 border border-dark">Alergi & ROTD</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">6</div>
                                <div class="col-md-7 border border-dark">Kontraindikasi</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">7</div>
                                <div class="col-md-7 border border-dark">Interaksi Obat</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">8</div>
                                <div class="col-md-7 border border-dark">Benar Obat</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">9</div>
                                <div class="col-md-7 border border-dark">Benar Dosis</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">10</div>
                                <div class="col-md-7 border border-dark">Benar Waktu</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">11</div>
                                <div class="col-md-7 border border-dark">Benar Cara Pemberian</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">12</div>
                                <div class="col-md-7 border border-dark">Benar Informasi</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-1 border border-dark">13</div>
                                <div class="col-md-7 border border-dark">Benar Dokumentasi</div>
                                <div class="col-md-2 border border-dark"></div>
                                <div class="col-md-2 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 border border-dark"><b>H (Harga)</b></div>
                                <div class="col-md-8 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 border border-dark"><b>R (Racik)</b></div>
                                <div class="col-md-8 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 border border-dark"><b>E (Etiket)</b></div>
                                <div class="col-md-8 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 border border-dark"><b>S (Serah)</b></div>
                                <div class="col-md-8 border border-dark"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 border border-dark text-center">
                                    <b>Menerima Obat Beserta Informasi</b>
                                    <br><br>
                                    (Pasien / Keluarga)
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 ">
                            <div class="row">
                                <div class="col-md-12 border border-dark text-center"><b>Perubahan Resep</b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 border border-dark text-center"><b>Tertulis</b></div>
                                <div class="col-md-6 border border-dark text-center"><b>Menjadi</b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 border border-dark text-center"><br><br></div>
                                <div class="col-md-6 border border-dark text-center"><br><br></div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-6 border border-dark text-center"><b>Petugas Farmasi</b></div>
                                <div class="col-md-6 border border-dark text-center"><b>Disetujui</b></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 border border-dark text-center"><br><br>..................</div>
                                <div class="col-md-6 border border-dark text-center"><br><br>..................</div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            {{-- <button class="btn btn-success btnPrint" onclick="printDiv('printMe')"><i class="fas fa-print"> Print
                    Laporan</i> --}}
        </div>
    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.DateRangePicker', true)
@section('plugins.Select2', true)
@section('css')
    <style type="text/css" media="print">
        hr {
            color: #333333 !important;
            border: 1px solid #333333 !important;
            line-height: 1.5;
        }

        pre {
            border: none;
            outline: none;
            padding: 0 !important;
            font-size: 15px;
        }

        .bg-warning {
            background-color: #ffc107 !important;
        }

        #resepobat {
            font-size: 22px !important;
            border: none;
            outline: none;
            padding: 0 !important;
        }

        .main-footer {
            display: none !important;
        }

        .btnPrint {
            display: none !important;
        }
    </style>
@endsection
@section('js')
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            tampilan_print = document.body.innerHTML = printContents;
            setTimeout('window.addEventListener("load", window.print());', 1000);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            window.print();
        });
        setTimeout(function() {
            window.top.close();
        }, 2000);
    </script>
@endsection
