<!-- ======= Testimonials Section ======= -->
<section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Testimonials</h2>
            <p>
                Kami sadar bahwa kesempurnaan adalah milik Tuhan Yang Maha Esa, dan ketidaksempurnaan senantiasa
                beriringan dengan manusia. Testimoni ini menjadikan kami selalu ingat bahwa pelayanan yang kami berikan
                dasarnya dari dalam hati. Kritik dan Saran yang disampaikan adalah semangat bagi kami untuk tidak pernah
                berhenti membuat klinik menjadi lebih baik dan bermanfaat, serta meberikan rasa aman dan nyaman.
            </p>
        </div>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Mengantar ibunda (kanker kelenjar getah bening) kemo ke-5 disini, sudah ada hasil yang cukup
                            significant & perawatnya ramah2. Mudah2an bisa sembuh total, aamiin.
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                        <img src="{{ asset('user.png') }}" class="testimonial-img" alt="">
                        <h3>Adu M</h3>
                        <h4>Pengantar Pasien</h4>
                    </div>
                </div><!-- End testimonial item -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Fasilitas kemonya setiap hari dan dokternya praktek setiap selasa dan sabtu..tempatnya
                            bersih dan nyaman serta pelayanannya sangat ramah
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                        <img src="{{ asset('user.png') }}" class="testimonial-img" alt="">
                        <h3>Anita Dwi Satya Wacana</h3>
                        <h4>Pengantar Pasien</h4>
                    </div>
                </div><!-- End testimonial item -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Fasilitas kemonya setiap hari..tempatnya
                            bersih dan nyaman serta pelayanannya sangat ramah
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                        <img src="{{ asset('user.png') }}" class="testimonial-img" alt="">
                        <h3>Anita Dwi Satya Wacana</h3>
                        <h4>Pengantar Pasien</h4>
                    </div>
                </div><!-- End testimonial item -->
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <p>
                            <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                            Pelayanan nya sangat Ramah dan Baik....Klinik LMC Terbaik....
                            <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                        </p>
                        <img src="{{ asset('user.png') }}" class="testimonial-img" alt="">
                        <h3>Ega Azis</h3>
                        <h4>Pengantar Pasien</h4>
                    </div>
                </div><!-- End testimonial item -->
                @foreach ($testimoni as $ts)
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <p>
                                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                {{ $ts->testimoni }}
                                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                            </p>
                            <img src="{{ asset('medicio/assets/img/testimonials/testimonials-2.jpg') }}"
                                class="testimonial-img" alt="">
                            <h3> {{ $ts->name }}</h3>
                            <h4> {{ $ts->subtitle }}</h4>
                        </div>
                    </div><!-- End testimonial item -->
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section><!-- End Testimonials Section -->
