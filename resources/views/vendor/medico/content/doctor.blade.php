    <!-- ======= Doctors Section ======= -->
    <section id="doctors" class="doctors section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Doctors</h2>
                {{-- <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit
                    sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias
                    ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p> --}}
            </div>
            <div class="row">
                @foreach ($dokters as $dr)
                    <div class="col-md-3  align-items-stretch">
                        <div class="member" data-aos="fade-up" data-aos-delay="100">
                            <div class="member-img">
                                @if ($dr->gender == 'P')
                                    <img src="{{ asset('img/dr-female.jpg') }}" width="100%" class="img-fluid max-width"
                                        alt="">
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
                                <h4>{{ $dr->namadokter }}</h4>
                                <span>{{ $dr->subtitle }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Doctors Section -->
