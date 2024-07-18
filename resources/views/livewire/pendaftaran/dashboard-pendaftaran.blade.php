<div>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box
                        title="{{ count($antrians) ? $antrians->where('taskid', '!=', 99)->count() : '-' }}"
                        text="Total Pasien" theme="success" icon="fas fa-user-injured" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box
                        title="{{ count($antrians) ? $antrians->where('jenispasien', 'JKN')->count() : '-' }}"
                        text="Pasien JKN" theme="warning" icon="fas fa-user-injured" />
                </div>
                <div class="col-lg-3 col-6">
                    <x-adminlte-small-box
                        title="{{ count($antrians) ? $antrians->where('jenispasien', 'NON-JKN')->count() : '-' }}"
                        text="Pasien NON-JKN" theme="warning" icon="fas fa-user-injured" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <x-adminlte-card theme="success" title="Daftar Pasien Perbulan">
                <div class="chart">
                    <canvas id="stackedBarChart"
                        style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
            </x-adminlte-card>
        </div>
    </div>
</div>
@push('js')
    <script>
        $(function() {
            var dataPasienUmum = {{ json_encode($antrianumum) }};
            var dataPasienBPJS = {{ json_encode($antrianjkn) }};
            var areaChartData = {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                    'Oktober', 'November', 'Desember'
                ],
                datasets: [{
                        label: 'Pasien Umum',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: dataPasienUmum
                    },
                    {
                        label: 'Pasien BPJS',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: dataPasienBPJS
                    },
                ]
            }
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0
            var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = $.extend(true, {}, barChartData)
            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
            new Chart(stackedBarChartCanvas, {
                type: 'bar',
                data: stackedBarChartData,
                options: stackedBarChartOptions
            })
        })
    </script>
    @section('plugins.Chartjs', true)
@endpush
