    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex align-items-center justify-content-center justify-content-md-between">
            <div class="align-items-center d-none d-md-flex">
                <a class="scrollto" href="{{ route('landingpage') }}#jadwal" style="color: white">
                    <i class="bi bi-clock"></i> Senin - Sabtu, 08:00 - 18:00
                </a>
            </div>
            <div class="d-flex align-items-center">
                <a href="https://wa.me/6281220877566" style="color: white" target="_blank">
                    <i class="bi bi-phone"></i> Whtastapp 0812-2087-7566
                </a>
            </div>
        </div>
    </div>
    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">
            <a href="{{ route('landingpage') }}" class="logo me-auto">
                <img src="{{ asset('kitasehat/logokitasehat.png') }}" alt="">
            </a>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <h1 class="logo me-auto"><a hrefp="index.html">Medicio</a></h1> -->
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto " href="{{ route('landingpage') }}">Home</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('landingpage') }}#about">Profil</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('landingpage') }}#jadwal">Jadwal</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('landingpage') }}#persyaratan">Persyaratan</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('landingpage') }}#departments">Poliklinik</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('landingpage') }}#doctors">Dokter</a></li>
                    {{-- <li><a class="nav-link scrollto" href="{{ route('statusantrian') }}">Status Antrian</a></li> --}}
                    {{-- <li><a class="nav-link scrollto" href="{{ route('ceksuratkontrol') }}">Surat Kontrol</a></li> --}}
                    {{-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i
                                        class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li> --}}
                    <li><a class="nav-link scrollto" href="{{ route('landingpage') }}#contact">Kontak</a></li>
                    @auth
                        <li><a class="nav-link scrollto" href="{{ route('home') }}">Dashboard</a></li>
                    @else
                        <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            {{-- <a href="{{ route('daftar') }}" class="appointment-btn scrollto"><span class="d-none d-md-inline"></span>
                Daftar</a> --}}
        </div>
    </header><!-- End Header -->
