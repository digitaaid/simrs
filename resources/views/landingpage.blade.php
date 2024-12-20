@extends('vendor.medico.master')
@section('title', 'Klink Luthfi Medical Center')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
            <div class="carousel-inner" role="listbox">
                <!-- Slide 1 -->
                <div class="carousel-item active" style="background-image: url({{ asset('lmc/3.jpg') }})">
                    <div class="container">
                        <h2>Klinik Utama Luthfi Medical Center</h2>
                        <p>Selamat datang di Klinik Utama Luthfi Medical Center. Kami siap memberikan pelayanan terbaik
                            untuk kesehatan anda.</p>
                        <a href="#about" class="btn-get-started scrollto">Tentang Kami</a>
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
    </section><!-- End Hero -->
    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="container" data-aos="fade-up">
            <div class="row">
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon"><i class="fas fa-user-md"></i></div>
                        <h4 class="title"><a href="">Dokter Konsultan Hematologi Onkologi Medik</a></h4>
                        <p class="description">
                            Dokter yang memiliki keahlian khusus dalam mendiagnosis menangani dan mengobati penyakit yang
                            diakibatkan oleh kelainan darah dan tindakan kemoterapi.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon"><i class="fas fa-user-md"></i></div>
                        <h4 class="title"><a href="">Dokter Konsultan Patologi Klinik</a></h4>
                        <p class="description">
                            Dokter konsultan yang memiliki keahlian khusus dalam bidang laboratorium (Pemeriksaan tumor
                            marker, kelainan darah/ genetik) untuk mendiagnosis memahami mekanisme penyakit serta memberikan
                            hasil yang relevan untuk pengobatan selanjutnya.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon"><i class="fas fa-hand-holding-medical"></i></div>
                        <h4 class="title"><a href="">Kemoterapi</a></h4>
                        <p class="description">
                            Prosedur pengobatan atau terapi kanker dengan memberikan obat-obatan untuk menghentikan atau
                            memperlambat pertumbuhan dan pembelahan sel kanker yang tumbuh dan berkembang dalam tubuh.
                            Dilakukan oleh tenaga profesional yang sudah melakukan pelatihan dan bersertifikat.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon"><i class="fas fa-diagnoses"></i></div>
                        <h4 class="title"><a href="">Patologi Anatomi</a></h4>
                        <p class="description">
                            Pelayanan diagnostik dan labratorium terhadap jaringan tubuh dan/ atau cairan tubuh. Berperan
                            sebagai penegakkan diagnosis yang berbasis perubahan morfologi sel dan jaringan sampai
                            pemeriksaan imunologik dan molekuler (Pemeriksaan Immunohistokimia/ IHK).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Featured Services Section -->
    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">
            <div class="text-center">
                <h3>
                    Pendaftaran Antrian Online
                    <br>
                    Silahkan pilih jenis pasien ?
                </h3>
                <p>
                    Kami menyediakan pelayanan bagi pasien BPJS maupun umum. Silakan pilih jenis pasien Anda di bawah ini
                    untuk mendapatkan informasi lebih lanjut tentang prosedur, layanan, dan manfaat yang tersedia untuk
                    Anda.
                </p>
                <a class="cta-btn scrollto" href="#">Antrian Pasien BPJS</a>
                <a class="cta-btn scrollto" href="#">Antrian Pasien Umum</a>
                <br>
                <br>
                <p>
                    Dengan memilih jenis pasien yang sesuai, kami akan memastikan bahwa Anda mendapatkan panduan yang
                    relevan dan penanganan terbaik sesuai kebutuhan Anda.
                </p>
            </div>
        </div>
    </section><!-- End Cta Section -->
    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Profil</h2>
                <p>
                    <b> Klinik Utama Luthfi Medical Center</b> adalah salah satu Klinik Utama yang memberikan pelayanan
                    khusus yaitu
                    pelayanan kemoterapi dan Hematologi Onkologi Medik. Klinik Utama Luthfi Medical Center didirikan pada
                    tanggal 01 Desember 2017 di Jalan Raya Sunan Gunung Jati No. 100 A/B, Desa Pasindangan Klayan, Kabupaten
                    Cirebon.
                </p>
            </div>
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="{{ asset('lmc/2.jpg') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
                    <p>
                        <b> Klinik Utama Luthfi Medical Center</b> didirikan untuk memenuhi kebutuhan masyarakat, khususnya
                        pelayanan Kemoterapi dan Hematologi yang terus berkembang, menyediakan pelayanan dokter spesialis
                        dan sub spesialis. Selanjutnya kedepan berencana menyediakan fasilitas yang lengkap guna memenuhi
                        kebutuhan pelayanan kesehatan masyarakat di bidang pelayanan Kemoterapi dan Hematologi.
                    </p>
                    <h3>Visi</h3>
                    <b>
                        “Menjadi Klinik Utama Terbaik dan Terlengkap di Wilayah III Cirebon dalam
                        pelayanan khususnya Kemoterapi dan Hematologi Onkologi Medik”.
                    </b>
                    <br> <br>
                    <h3>Misi</h3>
                    <ul>
                        <li><i class="bi bi-check-circle"></i>
                            Memberikan pelayanan Kemoterapi dan Hematologi yang bermutu, aman dan nyaman.
                        </li>
                        <li><i class="bi bi-check-circle"></i>
                            Melayani masyarakat dengan sarana dan prasarana terlengkap khususnya
                            pelayanan Kemoterapi dan Hematologi Onkologi Medik

                        </li>
                        <li><i class="bi bi-check-circle"></i>
                            Mengembangkan Sumber Daya Manusia yang jujur dan profesional.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section><!-- End About Us Section -->
    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
        <div class="container" data-aos="fade-up">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                        <i class="fas fa-user-md"></i>
                        <span data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>
                            <b>Dokter</b> Konsultan Hematologi Onkologi Medik
                            <br>
                            <b>Dokter</b> Konsultan Patologi Klinik
                        </p>
                        <a href="#">Find out more &raquo;</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                        <i class="fas fa-user-md"></i>
                        <span data-purecounter-start="0" data-purecounter-end="6" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>
                            <b>2 Dokter</b> Spesialis Penyakit Dalam
                            <br>
                            <b>2 Dokter</b> Spesialis Patologi Anatomi
                            <br>
                            <b>1 Dokter</b> Spesialis Radiologi
                            <br>
                            <b>1 Dokter</b> Umum
                        </p>
                        <a href="#">Find out more &raquo;</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                        <i class="fas fa-hand-holding-medical"></i>
                        <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Rata-rata tindakan kemoterapi setiap bulan.</p>
                        <a href="#">Find out more &raquo;</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
                    <div class="count-box">
                        <i class="fas fa-user-injured"></i>
                        <span data-purecounter-start="0" data-purecounter-end="400" data-purecounter-duration="1"
                            class="purecounter"></span>
                        <p>Rata-rata kunjungan rawat jalan/ Poliklinik setiap bulan.</p>
                        <a href="#">Find out more &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Counts Section -->
    <!-- ======= Services Section ======= -->
    <section id="services" class="services services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Services</h2>
                {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon"><i class="fas fa-hospital"></i></div>
                    <h4 class="title"><a href="">Poliklinik / Rawat Jalan</a></h4>
                    {{-- <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                        excepturi sint occaecati cupiditate non provident</p> --}}
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon"><i class="fas fa-hand-holding-medical"></i></div>
                    <h4 class="title"><a href="">Kemoterapi</a></h4>
                    {{-- <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat tarad limino ata</p> --}}
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon"><i class="fas fa-vials"></i></div>
                    <h4 class="title"><a href="">Laboratorium</a></h4>
                    {{-- <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                        dolore eu fugiat nulla pariatur</p> --}}
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon"><i class="fas fa-x-ray"></i></div>
                    <h4 class="title"><a href="">Radiologi</a></h4>
                    {{-- <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                        officia deserunt mollit anim id est laborum</p> --}}
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon"><i class="fas fa-diagnoses"></i></div>
                    <h4 class="title"><a href="">Cytotoxic Handling</a></h4>
                    {{-- <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                        blanditiis praesentium voluptatum deleniti atque</p> --}}
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon"><i class="fas fa-pills"></i></div>
                    <h4 class="title"><a href="">Farmasi</a></h4>
                    {{-- <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                        tempore, cum soluta nobis est eligendi</p> --}}
                </div>
            </div>

        </div>
    </section><!-- End Services Section -->
    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 order-2 order-lg-1" data-aos="fade-right">
                    <div class="icon-box mt-5 mt-lg-0">
                        <i class="bx bx-receipt"></i>
                        <h4>Est labore ad</h4>
                        <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                    </div>
                    <div class="icon-box mt-5">
                        <i class="bx bx-cube-alt"></i>
                        <h4>Harum esse qui</h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                    </div>
                    <div class="icon-box mt-5">
                        <i class="bx bx-images"></i>
                        <h4>Aut occaecati</h4>
                        <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                    </div>
                    <div class="icon-box mt-5">
                        <i class="bx bx-shield"></i>
                        <h4>Beatae veritatis</h4>
                        <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                    </div>
                </div>
                <div class="image col-lg-6 order-1 order-lg-2"
                    style='background-image: url("{{ asset('medicio/assets/img/features.jpg') }}");' data-aos="zoom-in">
                </div>
            </div>

        </div>
    </section><!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services services">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Services</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon"><i class="fas fa-heartbeat"></i></div>
                    <h4 class="title"><a href="">Lorem Ipsum</a></h4>
                    <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint
                        occaecati cupiditate non provident</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon"><i class="fas fa-pills"></i></div>
                    <h4 class="title"><a href="">Dolor Sitema</a></h4>
                    <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                        commodo consequat tarad limino ata</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon"><i class="fas fa-hospital-user"></i></div>
                    <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
                    <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">
                    <div class="icon"><i class="fas fa-dna"></i></div>
                    <h4 class="title"><a href="">Magni Dolores</a></h4>
                    <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit anim id est laborum</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
                    <div class="icon"><i class="fas fa-wheelchair"></i></div>
                    <h4 class="title"><a href="">Nemo Enim</a></h4>
                    <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis
                        praesentium voluptatum deleniti atque</p>
                </div>
                <div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
                    <div class="icon"><i class="fas fa-notes-medical"></i></div>
                    <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
                    <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore,
                        cum soluta nobis est eligendi</p>
                </div>
            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Appointment Section ======= -->
    <section id="appointment" class="appointment section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Make an Appointment</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <form action="forms/appointment.php" method="post" role="form" class="php-email-form"
                data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <div class="col-md-4 form-group">
                        <input type="text" name="name" class="form-control" id="name"
                            placeholder="Your Name" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Your Email" required>
                    </div>
                    <div class="col-md-4 form-group mt-3 mt-md-0">
                        <input type="tel" class="form-control" name="phone" id="phone"
                            placeholder="Your Phone" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 form-group mt-3">
                        <input type="datetime" name="date" class="form-control datepicker" id="date"
                            placeholder="Appointment Date" required>
                    </div>
                    <div class="col-md-4 form-group mt-3">
                        <select name="department" id="department" class="form-select">
                            <option value="">Select Department</option>
                            <option value="Department 1">Department 1</option>
                            <option value="Department 2">Department 2</option>
                            <option value="Department 3">Department 3</option>
                        </select>
                    </div>
                    <div class="col-md-4 form-group mt-3">
                        <select name="doctor" id="doctor" class="form-select">
                            <option value="">Select Doctor</option>
                            <option value="Doctor 1">Doctor 1</option>
                            <option value="Doctor 2">Doctor 2</option>
                            <option value="Doctor 3">Doctor 3</option>
                        </select>
                    </div>
                </div>

                <div class="form-group mt-3">
                    <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
                </div>
                <div class="my-3">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your appointment request has been sent successfully. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Make an Appointment</button></div>
            </form>

        </div>
    </section><!-- End Appointment Section -->

    <!-- ======= Departments Section ======= -->
    <section id="departments" class="departments">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Departments</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <ul class="nav nav-tabs flex-column">
                        <li class="nav-item">
                            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#tab-1">
                                <h4>Rawat Jalan</h4>
                                <p>Quis excepturi porro totam sint earum quo nulla perspiciatis eius.</p>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-2">
                                <h4>Rawat Inap</h4>
                                <p>Voluptas vel esse repudiandae quo excepturi.</p>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-3">
                                <h4>Instalasi Gawat Darurat</h4>
                                <p>Velit veniam ipsa sit nihil blanditiis mollitia natus.</p>
                            </a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-4">
                                <h4>Pediatrics</h4>
                                <p>Ratione hic sapiente nostrum doloremque illum nulla praesentium id</p>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-1">
                            <h3>Rawat Jalan</h3>
                            <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata
                                raqer a videna mareta paulona marka</p>
                            <img src="{{ asset('kitasehat/ruangdokter.jpg') }}" alt="" class="img-fluid">
                            <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum
                                ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis
                                magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <h3>Rawat Inap</h3>
                            <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata
                                raqer a videna mareta paulona marka</p>
                            <img src="{{ asset('kitasehat/ranap2.jpg') }}" alt="" class="img-fluid">
                            <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum
                                ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis
                                magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                        </div>
                        <div class="tab-pane" id="tab-3">
                            <h3>Instalasi Gawat Darurat</h3>
                            <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata
                                raqer a videna mareta paulona marka</p>
                            <img src="{{ asset('kitasehat/igd.jpg') }}" alt="" class="img-fluid">
                            <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum
                                ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis
                                magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                        </div>
                        <div class="tab-pane" id="tab-4">
                            <h3>Pediatrics</h3>
                            <p class="fst-italic">Qui laudantium consequatur laborum sit qui ad sapiente dila parde sonata
                                raqer a videna mareta paulona marka</p>
                            <img src="{{ asset('medicio/assets/img/departments-4.jpg') }}" alt=""
                                class="img-fluid">
                            <p>Et nobis maiores eius. Voluptatibus ut enim blanditiis atque harum sint. Laborum eos ipsum
                                ipsa odit magni. Incidunt hic ut molestiae aut qui. Est repellat minima eveniet eius et quis
                                magni nihil. Consequatur dolorem quaerat quos qui similique accusamus nostrum rem vero</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section><!-- End Departments Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Testimonials</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.
                                Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum
                                eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim
                                culpa.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('medicio/assets/img/testimonials/testimonials-2.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis
                                minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('medicio/assets/img/testimonials/testimonials-3.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim
                                velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum
                                veniam.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('medicio/assets/img/testimonials/testimonials-4.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam
                                enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore
                                nisi cillum quid.
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('medicio/assets/img/testimonials/testimonials-5.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Doctors</h2>
                <p>Tim dokter kami terdiri dari ahli yang berdedikasi dan berpengalaman, siap memberikan perawatan terbaik
                    dengan pendekatan profesional dan empati.</p>
            </div>
            <div class="row">
                @foreach ($dokters as $dr)
                    <div class="col-md-3  align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img">
                                @if ($dr->gender == 'P')
                                    <img src="{{ asset('img/dr-female.jpg') }}" width="100%"
                                        class="img-fluid max-width" alt="">
                                @else
                                    <img src="{{ asset('img/dr-male.jpg') }}" width="100%" class="img-fluid max-width"
                                        alt="">
                                @endif
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                            <div class="member-info">
                                <h4>{{ $dr->nama }}</h4>
                                <span>{{ $dr->title }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Doctors Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Gallery</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="gallery-slider swiper">
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-1.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-1.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-2.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-2.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-3.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-3.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-4.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-4.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-5.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-5.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-6.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-6.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-7.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-7.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                    <div class="swiper-slide"><a class="gallery-lightbox"
                            href="{{ asset('medicio/assets/img/gallery/gallery-8.jpg') }}"><img
                                src="{{ asset('medicio/assets/img/gallery/gallery-8.jpg') }}" class="img-fluid"
                                alt=""></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Pricing Section ======= -->
    <section id="pricing" class="pricing">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Pricing</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <div class="row">

                <div class="col-lg-3 col-md-6">
                    <div class="box" data-aos="fade-up" data-aos-delay="100">
                        <h3>Free</h3>
                        <h4><sup>$</sup>0<span> / month</span></h4>
                        <ul>
                            <li>Aida dere</li>
                            <li>Nec feugiat nisl</li>
                            <li>Nulla at volutpat dola</li>
                            <li class="na">Pharetra massa</li>
                            <li class="na">Massa ultricies mi</li>
                        </ul>
                        <div class="btn-wrap">
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                    <div class="box featured" data-aos="fade-up" data-aos-delay="200">
                        <h3>Business</h3>
                        <h4><sup>$</sup>19<span> / month</span></h4>
                        <ul>
                            <li>Aida dere</li>
                            <li>Nec feugiat nisl</li>
                            <li>Nulla at volutpat dola</li>
                            <li>Pharetra massa</li>
                            <li class="na">Massa ultricies mi</li>
                        </ul>
                        <div class="btn-wrap">
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                    <div class="box" data-aos="fade-up" data-aos-delay="300">
                        <h3>Developer</h3>
                        <h4><sup>$</sup>29<span> / month</span></h4>
                        <ul>
                            <li>Aida dere</li>
                            <li>Nec feugiat nisl</li>
                            <li>Nulla at volutpat dola</li>
                            <li>Pharetra massa</li>
                            <li>Massa ultricies mi</li>
                        </ul>
                        <div class="btn-wrap">
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                    <div class="box" data-aos="fade-up" data-aos-delay="400">
                        <span class="advanced">Advanced</span>
                        <h3>Ultimate</h3>
                        <h4><sup>$</sup>49<span> / month</span></h4>
                        <ul>
                            <li>Aida dere</li>
                            <li>Nec feugiat nisl</li>
                            <li>Nulla at volutpat dola</li>
                            <li>Pharetra massa</li>
                            <li>Massa ultricies mi</li>
                        </ul>
                        <div class="btn-wrap">
                            <a href="#" class="btn-buy">Buy Now</a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Pricing Section -->

    <!-- ======= Frequently Asked Questioins Section ======= -->
    <section id="faq" class="faq section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>Frequently Asked Questioins</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

            <ul class="faq-list">

                <li>
                    <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Non consectetur a erat nam
                        at lectus urna duis? <i class="bi bi-chevron-down icon-show"></i><i
                            class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq1" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non
                            curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                        </p>
                    </div>
                </li>

                <li>
                    <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Feugiat scelerisque varius
                        morbi enim nunc faucibus a pellentesque? <i class="bi bi-chevron-down icon-show"></i><i
                            class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq2" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit
                            laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est
                            pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt
                            dui.
                        </p>
                    </div>
                </li>

                <li>
                    <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dolor sit amet consectetur
                        adipiscing elit pellentesque habitant morbi? <i class="bi bi-chevron-down icon-show"></i><i
                            class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq3" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar
                            elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus
                            pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at
                            elementum eu facilisis sed odio morbi quis
                        </p>
                    </div>
                </li>

                <li>
                    <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Ac odio tempor orci dapibus.
                        Aliquam eleifend mi in nulla? <i class="bi bi-chevron-down icon-show"></i><i
                            class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq4" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit
                            laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est
                            pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt
                            dui.
                        </p>
                    </div>
                </li>

                <li>
                    <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Tempus quam pellentesque nec
                        nam aliquam sem et tortor consequat? <i class="bi bi-chevron-down icon-show"></i><i
                            class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq5" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante
                            in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum
                            est. Purus gravida quis blandit turpis cursus in
                        </p>
                    </div>
                </li>

                <li>
                    <div data-bs-toggle="collapse" href="#faq6" class="collapsed question">Tortor vitae purus faucibus
                        ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i
                            class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
                    <div id="faq6" class="collapse" data-bs-parent=".faq-list">
                        <p>
                            Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer
                            malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor
                            sed. Ut venenatis tellus in metus vulputate eu scelerisque. Pellentesque diam volutpat commodo
                            sed egestas egestas fringilla phasellus faucibus. Nibh tellus molestie nunc non blandit massa
                            enim nec.
                        </p>
                    </div>
                </li>

            </ul>

        </div>
    </section><!-- End Frequently Asked Questioins Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <h2>Contact</h2>
                <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                    consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat
                    sit in iste officiis commodi quidem hic quas.</p>
            </div>

        </div>
        <div>
            <iframe style="border:0; width: 100%; height: 350px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.5594178785326!2d108.75051453684007!3d-6.8965020672288615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f0925960fd16f%3A0x7bf3a09815473d47!2sKlinik%20Utama%20Kita%20Sehat!5e0!3m2!1sid!2sid!4v1715662862407!5m2!1sid!2sid"
                frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="container">

            <div class="row mt-5">

                <div class="col-lg-6">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-box">
                                <i class="bx bx-map"></i>
                                <h3>Our Address</h3>
                                <p>A108 Adam Street, New York, NY 535022</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box mt-4">
                                <i class="bx bx-envelope"></i>
                                <h3>Email Us</h3>
                                <p>info@example.com<br>contact@example.com</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-box mt-4">
                                <i class="bx bx-phone-call"></i>
                                <h3>Call Us</h3>
                                <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6">
                    <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Your Name" required="">
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email" required="">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" id="subject"
                                placeholder="Subject" required="">
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" rows="7" placeholder="Message" required=""></textarea>
                        </div>
                        <div class="my-3">
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">Your message has been sent. Thank you!</div>
                        </div>
                        <div class="text-center"><button type="submit">Send Message</button></div>
                    </form>
                </div>

            </div>

        </div>
    </section><!-- End Contact Section -->

    </main><!-- End #main -->

    @include('vendor.medico.footer')
@endsection
@section('css')
    @include('lmc_css')
@endsection
