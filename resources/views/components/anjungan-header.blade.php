<div class="card">
    <header class="bg-{{ config('adminlte.anjungan_color') }} text-white p-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <img src="{{ asset(config('adminlte.logo_img')) }}" width="80">
                        <div class="col">
                            <h2>Anjungan Antrian</h2>
                            <h4>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h1>{{ config('adminlte.title') }}</h1>
                </div>
            </div>
        </div>
    </header>
</div>
