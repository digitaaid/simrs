   <!-- ======= Frequently Asked Questioins Section ======= -->
   <section id="jadwal" class="faq ">
       <div class="container" data-aos="fade-up">
           <div class="section-title">
               <h2>Jadwal Dokter</h2>
               <p>
                   Jadwal praktik dokter dapat berubah sewaktu-waktu. Harap cek dan pastikan kembali sebelum mendaftar.
                   Apabila ada perubahan, sistem akan mengirimkan pesan otomatis ke nomor WhatsApp yang sudah terdaftar,
                   atau petugas pelayanan kami akan berusaha menghubungi. Terima kasih atas perhatiannya,
                   salam sehat selalu.
               </p>
           </div>
           <ul class="faq-list">
               @php
                   $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

               @endphp
               @for ($i = 1; $i <= 6; $i++)
                   <li>
                       <div data-bs-toggle="collapse" class="collapsed question" href="#faq{{ $i }}">
                           {{ $hari[$i - 1] }}
                           <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                       </div>
                       <div id="faq{{ $i }}" class="collapse" data-bs-parent=".faq-list">
                           <p>
                           <table class="table table-sm">
                               <thead>
                                   <tr>
                                       <th scope="col">Jam Praktek</th>
                                       <th scope="col">Dokter</th>
                                       <th scope="col">Poliklinik</th>
                                       <th scope="col">Kuota</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @foreach ($jadwals->where('hari', $i) as $item)
                                       <tr class="{{ $item->libur ? 'table-danger' : null }}">
                                           <td>{{ strtoupper($item->jadwal) }}</td>
                                           <td>{{ strtoupper($item->namadokter) }}</td>
                                           <td>{{ $item->namasubspesialis }}</td>
                                           <td>{{ $item->kapasitaspasien }}</td>
                                       </tr>
                                   @endforeach
                               </tbody>
                           </table>
                           </p>
                       </div>
                   </li>
               @endfor
               @foreach ($tanyajawab as $tj)
                   <li>
                       <div data-bs-toggle="collapse" href="#faqs{{ $tj->id }}" class="collapsed question">
                           {{ $tj->pertanyaan }}
                           <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i>
                       </div>
                       <div id="faqs{{ $tj->id }}" class="collapse" data-bs-parent=".faq-list">
                           <p>
                               {{ $tj->jawaban }}
                           </p>
                       </div>
                   </li>
               @endforeach
           </ul>
       </div>
   </section><!-- End Frequently Asked Questioins Section -->
