<x-adminlte-card title="Informasi Anjunan Antrian" theme="{{ config('adminlte.anjungan_color') }}" icon="fas fa-info-circle">
    <div class="text-center">
        <img src="{{ asset(config('adminlte.anjungan_qr')) }}" width="45%" alt="">
        <img src="{{ asset(config('adminlte.anjungan_img_info')) }}" width="45%" alt="">
        <br>
    </div>
</x-adminlte-card>
