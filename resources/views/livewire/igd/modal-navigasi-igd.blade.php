<div class="col-md-3">
    <x-adminlte-card theme="primary" title="Navigasi" body-class="p-0">
        <ul class="nav nav-pills flex-column">
            <li class="nav-item">
                <a href="#datapasien" class="nav-link">
                    <i class="fas fa-users"></i> Data Pasien
                    <span class="badge bg-success float-right">Pasien</span>
                </a>
                <a href="#datapasien" class="nav-link">
                    <i class="fas fa-users"></i> Data Pasien
                    <span class="badge bg-success float-right">Pasien</span>
                </a>
            </li>
        </ul>
        <x-slot name="footerSlot">
            <div wire:loading>
                <div class="spinner-border spinner-border-sm text-primary" role="status">
                </div>
                Loading ...
            </div>
        </x-slot>
    </x-adminlte-card>
</div>
