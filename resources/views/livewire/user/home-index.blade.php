<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Selamat Datang {{ auth()->user()->name }},</h5>
                <p class="mb-0">Anda Login sebagai {{ auth()->user()->roles?->first()?->name }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        @livewire('dashboard.jadwal-absensi', ['lazy' => true])
    </div>
    <div class="col-md-6">
        @livewire('dashboard.jadwal-dokter', ['lazy' => true])
    </div>
    <div class="col-md-6">
        @livewire('dashboard.log-index', ['lazy' => true])
    </div>
</div>
