<div>
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url({{ asset('kitasehat/depan.jpg') }})">
                    <div class="container">
                        <h2>Pendaftaran Antrian Online</h2>
                        <p>Kami berkomitmen untuk memberikan pelayanan kesehatan terbaik bagi Anda dan keluarga. Dengan
                            tim
                            medis yang profesional dan berpengalaman, serta fasilitas yang lengkap dan modern, kami siap
                            membantu Anda mencapai kesehatan optimal</p>
                        <a href="#daftar" class="btn-get-started scrollto">Read More</a>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item" style="background-image: url({{ asset('kitasehat/ranap1.jpg') }})">
                    <div class="container">
                        <h2>Pelayanan Rawat Inap</h2>
                        <p>Pelayanan Rawat Inap di Klinik Utama Kita Sehat dirancang untuk memberikan kenyamanan dan
                            perawatan terbaik bagi pasien. Kami menawarkan kamar yang bersih dan nyaman. Tim medis kami,
                            terdiri dari dokter
                            spesialis dan perawat yang berpengalaman, siap memberikan perawatan yang personal dan
                            profesional selama 24 jam. </p>
                        <a href="#about" class="btn-get-started scrollto">Read More</a>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>

        </div>
    </section>
    <section id="daftar" class="inner-page">
        <div class="container">
            <p>
                Example inner page template
            </p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label>NIK</label>
                        <input wire:model='nik' name="nik" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label>No HP</label>
                        <input wire:model='nohp' name="nohp" class="form-control">
                    </div>
                    @if ($pasien)
                        <div class="form-group mb-2">
                            <label>No BPJS</label>
                            <input wire:model='nomorkartu' name="nomorkartu" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label>No RM</label>
                            <input wire:model='norm' name="norm" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label>Nama</label>
                            <input wire:model='nama' name="nama" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label>Tanggal Periksa</label>
                            <input wire:model='tanggalperiksa' type="date" name="tanggalperiksa"
                                class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label>Select</label>
                            <select wire:model='jenispasien' name="jenispasien" class="form-control">
                                <option value=null>Pilih Jenis Pasien</option>
                                <option value="JKN">BPJS / JKN</option>
                                <option value="NON-JKN">UMUM / NON-JKN</option>
                            </select>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    @if (count($jadwals))
                        <div class="form-group mb-2">
                            <label>Jadwal</label>
                            <select wire:model='jadwal' name="jadwal" class="form-control">
                                <option value=null>Pilih Jenis Pasien</option>
                                @foreach ($jadwals as $item)
                                    <option value="{{ $item->id }}">{{ $item->jampraktek }} {{ $item->namapoli }}
                                        {{ $item->namadokter }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    @if ($pasien)
                        @if (count($jadwals))
                            <button wire:click='daftarAntrian' class="btn btn-warning">Daftar</button>
                        @else
                            <button wire:click='cekJadwal' class="btn btn-warning">Cek Jadwal</button>
                        @endif
                    @else
                        <button wire:click='cekPasien' class="btn btn-warning">Cek Pasien</button>
                    @endif
                    <div wire:loading>
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                        </div>
                        Loading ...
                    </div>
                    @if (flash()->message)
                        <div class="text-{{ flash()->class }}" wire:loading.remove>
                            Loading Result : {{ flash()->message }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
