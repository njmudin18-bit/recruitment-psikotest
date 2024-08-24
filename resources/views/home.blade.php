<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $Title }} | {{ config('appsproperties.APPS_NAME') }}</title>
    <!-- Meta header and App favicon start -->
    <x-meta-header :subtitle="$SubTitle"></x-metas>
    <!-- Meta header and App favicon end -->
    <!-- Css standard start -->
    <x-css-standard></x-css-standard>
    <!-- Css standard end -->
    <style>
      p i.fas {
        cursor: pointer;
      }
    </style>
  </head>
  <body data-sidebar="dark" data-layout-mode="light">

    <!-- Begin page -->
    <div id="layout-wrapper">
      <!-- Topbar start -->
      <x-top-bar />
      <!-- Topbar start end -->

      <!-- Left Sidebar Start -->
      <x-left-side-bar />
      <!-- Left Sidebar End -->

      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="main-content">
        <div class="page-content">
          <div class="container-fluid">
              <!-- start page title -->
              <x-page-title :title="$Title" :subtitle="$SubTitle" />
              <!-- end page title -->
              @if ($User->roles()->where('name', 'Pelamar')->exists())
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <h5 class="card-header bg-transparent border-bottom">Selamat datang di Aplikasi e-Recruitment {{ strtoupper(config('appsproperties.COMPANY_NAME')) }}</h5>
                      <div class="card-body">
                        <h4 class="card-title">Hi <strong class="text-danger">{{ Auth::user()->name }}</strong>,</h4>
                        <p class="mt-4">Untuk memulai proses pendaftaran lamaran, mohon baca dengan seksama <strong>syarat dan ketentuan</strong> yang berlaku. 
                          Setelah itu, silakan lengkapi formulir identitas diri, keluarga & lingkungan, 
                          tambahan lainnya, catatan tambahan, dan pengalaman kerja
                          serta unggah dokumen-dokumen yang diperlukan sesuai dengan instruksi yang tertera.</p>
                        <p class="mt-2">Tim rekrutmen kami akan meninjau kelengkapan dan keabsahan data Anda. 
                          Kandidat yang memenuhi kualifikasi akan dihubungi untuk proses selanjutnya.</p>
                        <p class="mt-2">Terima kasih atas minat Anda untuk bergabung dengan {{ strtoupper(config('appsproperties.COMPANY_NAME')) }}.</p>

                        <h5 class="fw-bold mt-4">1. Panduan untuk calon pelamar baru</h5>
                        <p class="mt-3">Bagi calon pelamar baru, silakan merujuk pada tabel di bawah ini untuk mengetahui informasi lengkap mengenai formulir yang perlu diisi dan dokumen yang perlu diunggah.</p>
                        <p class="mt-3">Lalu cetak identitas diri yang telah anda lengkapi dengan menekan tombol 
                          bertuliskan 
                          <strong>cetak berwarna hijau</strong> klik tanda tanya untuk info lebih lengkap.
                          <a tabindex="0" class="fas fa-question-circle fa-lg text-danger" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCetak" aria-controls="offcanvasCetak"></a>
                        </p>
                        
                        <p class="text-danger">Untuk informasi detail mengenai formulir dan dokumen yang diperlukan, silakan merujuk pada tabel di bawah.</p>

                        <h5 class="fw-bold mt-4">2. Panduan untuk pegawai kontrak</h5>
                        <p class="mt-3">Bagi para pegawai kontrak, berikut langkah-langkah awal yang perlu Anda ikuti:</p>
                        <ul>
                          <li><strong>Harap lengkapi semua formulir</strong>, jika Anda baru pertama kali menggunakan aplikasi ini.</li>
                          <li><strong>Harap unggah semua dokumen</strong>, yang diperlukan jika Anda baru pertama kali menggunakan aplikasi ini.</li>
                          <li><strong>Untuk pembaruan kontrak</strong>, Anda cukup mengunggah <strong>Surat Lamaran Baru</strong>.
                            <a tabindex="0" class="fas fa-question-circle fa-lg text-danger" role="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDokumen" aria-controls="offcanvasDokumen"></a>
                          </li>
                        </ul>
                        <p class="text-danger">Untuk informasi detail mengenai formulir dan dokumen yang diperlukan, silakan merujuk pada tabel di bawah.</p>
                        
                        <h5 class="fw-bold mt-4">3. Tabel formulir dan dokumen kelengkapan persyaratan</h5>
                        <p class="mt-3 mb-3"><strong>Tanda centang akan muncul secara otomatis</strong> di setiap formulir setelah Anda menyelesaikan pengisian atau pengunggahan dokumen yang diperlukan.</p>
                        <!-- <div class="table-responsive mt-3">
                          <table class="table table-bordered table-nowrap mb-0">
                            <thead>
                              <tr class="bg-primary text-white">
                                <th class="text-center">1. IDENTITAS PRIBADI</th>
                                <th class="text-center">2. KELUARGA DAN LINGKUNGAN</th>
                                <th class="text-center">3. TAMBAHAN SAYA LAINNYA</th>
                                <th class="text-center">4. CATATAN TAMBAHAN</th>
                                <th class="text-center">5. LAMPIRAN DOKUMEN</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="text-center">
                                  <p>1. Data Pribadi @if ($Identitas > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                </td>
                                <td class="text-center">
                                  <p>1. Data Pasangan @if ($Pasangan > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                  <p>2. Data Kontak Darurat @if ($Kontak > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                  <p>3. Data Anak @if ($Anak > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                  <p>4. Data Ayah dan Ibu @if ($Orangtua > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                  <p>5. Data Saudara Kandung @if ($Saudara > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                </td>
                                <td class="text-center">
                                  <p>1. Pengalaman Kerja @if ($Pengalaman > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                  <p>2. Skill, Bahasa dan Olahraga dll @if ($Tambahansatu > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                  <p>3. Pendidikan/ pengembangan lainnya @if ($Tambahandua > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                  <p>4. Pertanyaan-pertanyaan @if ($Jawaban > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i> @endif</p>
                                </td>
                                <td class="text-center">
                                  <p>1. Surat Lamaran @if ($ArrayDoc['DocLamaran'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                  <p>2. CV @if ($ArrayDoc['DocCV'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                  <p>3. KTP @if ($ArrayDoc['DocKTP'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                  <p>4. NPWP<strong>**</strong> @if ($ArrayDoc['DocNPWP'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum dilengkapi & opsional jika ada"></i>@endif</p>
                                  <p>5. Ijazah @if ($ArrayDoc['DocIjazah'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                  <p>6. SKCK @if ($ArrayDoc['DocSKCK'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                  <p>7. Kartu Keluarga @if ($ArrayDoc['DocKK'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                  <p>8. Surat Dokter @if ($ArrayDoc['DocDokter'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                  <p>9. Surat Vaksin<strong>**</strong> @if ($ArrayDoc['DocVaksin'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum dilengkapi & opsional jika ada"></i>@endif</p>
                                  <p>10. Pas Foto @if ($ArrayDoc['DocFoto'] > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum & harus dilengkapi"></i>@endif</p>
                                </td>
                                <td class="text-center">
                                  <p>1. Catatan tambahan** @if ($Catatan > 0) <i class="fas fa-check-circle text-success ms-2 fa-lg" title="Sudah dilengkapi"></i>@else <i class="fas fa-exclamation-circle text-danger ms-2 fa-lg" title="Belum dilengkapi & opsional jika ada"></i>@endif</p>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div> -->

                        <!-- NEW TABLE -->
                        <div class="container">
                          <div class="mt-2">
                            <!-- 1. IDENTITAS PRIBADI	 -->
                            <div class="btn btn-outline-primary waves-effect waves-light w-100 my-2 py-3">
                              <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                  <h5 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                    1. IDENTITAS PRIBADI
                                  </h5>
                                </div>
                                <ul class="list-unstyled mb-0 col-12 col-md-6 text-dark-l1 text-90 text-start my-2 my-md-0">
                                  <li>
                                    @if ($Identitas > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      1. Data Pribadi
                                    </span>
                                  </li>
                                </ul>
                              </div>
                            </div>

                            <!-- 2. KELUARGA DAN LINGKUNGAN	 -->
                            <div class="btn btn-outline-primary waves-effect waves-light w-100 my-2 py-3">
                              <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                  <h5 class="pt-3 text-170 text-600 text-green-d1 letter-spacing">
                                    2. KELUARGA DAN LINGKUNGAN
                                  </h5>
                                </div>
                                <ul class="list-unstyled mb-0 col-12 col-md-6 text-dark-l1 text-90 text-start my-2 my-md-0">
                                  <li>
                                    @if ($Pasangan > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      1. Data Pasangan
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($Kontak > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      2. Data Kontak Darurat
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($Anak > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      3. Data Anak
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($Orangtua > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      4. Data Ayah dan Ibu
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($Saudara > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      5. Data Saudara Kandung
                                    </span>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            
                            <!-- 3. TAMBAHAN SAYA LAINNYA	 -->
                            <div class="btn btn-outline-primary waves-effect waves-light w-100 my-2 py-3">
                              <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                  <h5 class="pt-3 text-170 text-600 text-green-d1 letter-spacing">
                                    3. TAMBAHAN SAYA LAINNYA
                                  </h5>
                                </div>
                                <ul class="list-unstyled mb-0 col-12 col-md-6 text-dark-l1 text-90 text-start my-2 my-md-0">
                                  <li>
                                    @if ($Pengalaman > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      1. Pengalaman Kerja
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($Tambahansatu > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      2. Skill, Bahasa dan Olahraga dll
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($Tambahandua > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      3. Pendidikan/ pengembangan lainnya
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($Jawaban > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      4. Pertanyaan-pertanyaan
                                    </span>
                                  </li>
                                </ul>
                              </div>
                            </div>

                            <!-- 4. CATATAN TAMBAHAN	 -->
                            <div class="btn btn-outline-primary waves-effect waves-light w-100 my-2 py-3">
                              <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                  <h5 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                    4. CATATAN TAMBAHAN
                                  </h5>
                                </div>
                                <ul class="list-unstyled mb-0 col-12 col-md-6 text-dark-l1 text-90 text-start my-2 my-md-0">
                                  <li>
                                    @if ($Catatan > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      1. Catatan tambahan**
                                    </span>
                                  </li>
                                </ul>
                              </div>
                            </div>

                            <!-- 5. LAMPIRAN DOKUMEN	 -->
                            <div class="btn btn-outline-primary waves-effect waves-light w-100 my-2 py-3">
                              <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                  <h5 class="pt-3 text-170 text-600 text-green-d1 letter-spacing">
                                    5. LAMPIRAN DOKUMEN
                                  </h5>
                                </div>
                                <ul class="list-unstyled mb-0 col-12 col-md-3 text-dark-l1 text-90 text-start my-2 my-md-0">
                                  <li>
                                    @if ($ArrayDoc['DocLamaran'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      1. Surat Lamaran
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocCV'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      2. CV
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocKTP'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      3. KTP
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocNPWP'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      4. NPWP
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocIjazah'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      5. Ijazah
                                    </span>
                                  </li>
                                </ul>
                                <ul class="list-unstyled mb-0 col-12 col-md-3 text-dark-l1 text-90 text-start my-2 my-md-0">
                                  <li>
                                    @if ($ArrayDoc['DocSKCK'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      6. SKCK
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocKK'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      7. Kartu Keluarga
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocDokter'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      8. Surat Dokter
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocVaksin'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      9. Surat Vaksin
                                    </span>
                                  </li>
                                  <li class="mt-2">
                                    @if ($ArrayDoc['DocFoto'] > 0)
                                      <i class="fa fa-check text-success text-110 me-3 mt-1 fa-lg" title="Sudah dilengkapi"></i>
                                    @else
                                      <i class="fas fa-exclamation-circle text-danger text-110 me-3 mt-1 fa-lg" title="Belum & harus dilengkapi"></i>
                                    @endif
                                    <span class="text-110">
                                      10. Pas Foto
                                    </span>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            
                          </div>
                        </div>
                        <!-- NEW TABLE -->

                        <h6 class="fw-bold mt-2 mt-4">NOTE:</h6>
                        <ol class="mt-2">
                          <li><strong>**</strong> Opsional jika ada.</li>
                          <li><i class="fas fa-exclamation-circle text-danger me-1"></i> Semua formulir dan dokumen harus dilengkapi.</li>
                        </ol>
                      </div>
                    </div>
                  </div> <!-- end col -->
                </div>
              @else
                <div class="row">
                  <div class="col-xl-4">
                    <div class="card overflow-hidden">
                      <div class="bg-primary bg-soft">
                        <div class="row">
                          <div class="col-7">
                            <div class="text-primary p-3">
                              <h5 class="text-primary">Welcome Back !</h5>
                              <!-- <p>{{ ucfirst(Auth::user()->name) }}</p> -->
                            </div>
                          </div>
                          <div class="col-5 align-self-end">
                            <img src="{{ asset('assets/images/profile-img.png') }}" alt="" class="img-fluid">
                          </div>
                        </div>
                      </div>
                      <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="avatar-md profile-user-wid mb-4">
                                  @if (getPhotoUser() == null)
                                    <img src="{{ asset('assets/images/users/avatar.png') }}" alt="{{ ucfirst(Auth::user()->name) }}" style="width: 63px;height: 63px;" class="img-thumbnail rounded-circle">
                                  @else
                                    <img src="{{ url('/') }}/{{ $PasFoto->File }}" alt="{{ ucfirst(Auth::user()->name) }}" style="width: 63px;height: 63px;" class="img-thumbnail rounded-circle">
                                  @endif
                                </div>
                                <h5 class="font-size-15 text-truncate">{{ ucfirst(Auth::user()->name) }}</h5>
                                <p class="text-muted mb-0 text-truncate">{{ strtolower(Auth::user()->email) }}</p>
                            </div>

                            <div class="col-sm-6">
                              <div class="pt-4">
                                <div class="mt-4">
                                  <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Profile <i class="mdi mdi-arrow-right ms-1"></i></a>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title mb-4">Total Dokumen</h4>
                        <div class="row">
                          <div class="col-sm-12">
                            <p class="text-muted text-center">Semua dokumen terunggah</p>
                            <!-- <h3 class="text-center">{{ $TotalDokumen }}</h3> -->
                          </div>
                          <div class="col-sm-12 text-center">
                            <div class="mt-4 mt-sm-0">
                              <div id="radialBar-chart" data-colors='["--bs-primary"]' class="apex-charts"></div>
                            </div>
                          </div>
                        </div>
                        <p class="text-muted mb-0">Surat lamaran, CV, KTP, NPWP, Foto dll.</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-8">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card mini-stats-wid">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Surat Lamaran</p>
                                <h4 class="mb-0">{{ $SuratLamaran }}</h4>
                              </div>

                              <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                  <span class="avatar-title">
                                    <i class="bx bx-copy-alt font-size-24"></i>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card mini-stats-wid">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Total Pelamar</p>
                                <h4 class="mb-0">{{ $Pelamar }}</h4>
                              </div>

                              <div class="flex-shrink-0 align-self-center ">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                  <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bxs-user-badge font-size-24"></i>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card mini-stats-wid">
                          <div class="card-body">
                            <div class="d-flex">
                              <div class="flex-grow-1">
                                <p class="text-muted fw-medium">Total Pengguna</p>
                                <h4 class="mb-0">{{ $UserInternal }}</h4>
                              </div>

                              <div class="flex-shrink-0 align-self-center">
                                <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                  <span class="avatar-title rounded-circle bg-primary">
                                    <i class="bx bxs-user-plus font-size-24"></i>
                                  </span>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end row -->

                    <div class="card">
                      <div class="card-body">
                        <div class="d-sm-flex flex-wrap">
                          <h4 class="card-title mb-4">Statistik pelamar</h4>
                          <div class="ms-auto">
                            <ul class="nav nav-pills">
                              <li class="nav-item">
                                <a class="nav-link active" href="#">Tahun {{ date('Y') }} </a>
                              </li>
                            </ul>
                          </div>
                        </div>
                          
                        <div id="stacked-column-chart" class="apex-charts" data-colors='["--bs-primary", "--bs-warning", "--bs-success"]' dir="ltr"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end row -->

                <div class="row">
                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title mb-4">
                          Pelamar terbaru
                          <span class="float-end">
                            <a href="{{ route('report.index') }}" class="btn btn-primary waves-effect waves-light btn-sm">
                              View more 
                              <i class="mdi mdi-arrow-right ms-1"></i>
                            </a>
                          </span>
                        </h4>
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered align-middle table-nowrap mb-0">
                            <thead>
                              <tr class="bg-primary text-white text-center">
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center" width="10%">#</th>
                                <th class="text-center" width="10%">Department</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Posisi</th>
                                <th class="text-center" width="5%">Usia</th>
                                <th class="text-center" width="5%">JK</th>
                                <th class="text-center" width="10%">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center" width="10%">Tgl. Melamar</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (count($PelamarTerbaru) > 0)
                                @foreach ($PelamarTerbaru as $key => $item)
                                  @php ($UserID = $item->CreatedBy)
                                  <tr>
                                    <td class="text-end">{{ $key+1 }}</td>
                                    <td>
                                      <button type="button" name="view" onclick="view({{ $UserID }})" class="btn btn-info btn-sm me-2" title="Cek full data diri">
                                        <i class="bx bx-search-alt"></i>
                                      </button>
                                    </td>
                                    <td>{{ $item->Department }}</td>
                                    <td>{{ $item->Nama }}</td>
                                    <td>{{ capitalizeWords($item->Posisi) }}</td>
                                    <td class="text-center">{{ getUsiaPelamar($item->TanggalLahir) }}</td>
                                    <td class="text-center">{{ $item->Jk }}</td>
                                    <td class="text-center">{{ $item->NoHp }}</td>
                                    <td>{{ $item->Email }}</td>
                                    <td>{{ $item->CreatedDate }}</td>
                                  </tr>
                                @endforeach
                              @else
                              <tr>
                                <td colspan="10" class="text-center">Data tidak ditemukan</td>
                              </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end row -->
              @endif
          </div>
          <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <!-- Footer start -->
        <x-footer-bar />
        <!-- Footer end -->

        <!-- right offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCetak" aria-labelledby="offcanvasCetakLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Cara cetak formulir identitas diri</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ol>
              <li class="mb-1">Klik menu Pelamar.</li>
              <li class="mb-1">Klik sub menu Identitas Pribadi.</li>
              <li class="mb-1">Klik tombol berwarna biru (akan muncuk jika data sudah diisi).</li>
              <li class="mb-1">Maka akan muncul halaman baru, lalu klik tombol <strong>hijau bertuliskan cetak</strong>.</li>
            </ol>
            <img src="{{ asset('assets/images/Petunjuk-cetak.png') }}" class="img-thumbnail" alt="Cara cetak" width="100%" height="auto">
          </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDokumen" aria-labelledby="offcanvasDokumenLabel">
          <div class="offcanvas-header">
            <h5 id="offcanvasRightLabel">Cara unggah Dokumen</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ol>
              <li class="mb-1">Klik menu Pelamar.</li>
              <li class="mb-1">Klik sub menu Upload Dokumen.</li>
              <li class="mb-1">Isi kelengkapan data dan pilih <strong>Type Dokumen Surat Lamaran</strong>.</li>
              <li class="mb-1">Lalu tekan <strong>tombol Save</strong> untuk mengirimkan surat lamaran anda.</li>
            </ol>
            <img src="{{ asset('assets/images/Petunjuk-upload-dokumen.png') }}" class="img-thumbnail" alt="Cara cetak" width="100%" height="auto">
          </div>
        </div>

      </div>
      <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- Right Sidebar -->
    <x-right-side-bar />
    <!-- /Right-bar -->

    <!-- JAVASCRIPT start -->
    <x-js-standard></x-js-standard>
    <!-- JAVASCRIPT end -->

    <!-- apexcharts -->
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ asset('assets/js/pages/dashboard.init.js') }}"></script>
    <!-- App js -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @include('components.swaltoast')
    <script>
      var options, chart, radialbarColors = getChartColorsArray("radialBar-chart");
      radialbarColors &&
      ((options = {
        chart: { height: 200, type: "radialBar", offsetY: -10 },
        plotOptions: {
          radialBar: {
            startAngle: -135,
            endAngle: 135,
            dataLabels: {
              name: { fontSize: "13px", color: void 0, offsetY: 60 },
              value: {
                offsetY: 22,
                fontSize: "16px",
                color: void 0,
                formatter: function (e) {
                  return e + "";
                },
              },
            },
          },
        },
        colors: radialbarColors,
        fill: { type: "gradient", gradient: { shade: "dark", shadeIntensity: 0.15, inverseColors: !1, opacityFrom: 1, opacityTo: 1, stops: [0, 50, 65, 91] } },
        stroke: { dashArray: 4 },
        series: [{{ $TotalDokumen }}],
        labels: ["Total"],
      }),
      (chart = new ApexCharts(document.querySelector("#radialBar-chart"), options)).render());
    </script>
    <script>
      function view(id) {
        let URL = "{{ url('identitas-preview/') }}/" + id;
        window.open(URL, '_blank');
      }

      function load_grafik_data() {
        $.ajax({
          data: {
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('home.grafik') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            let Result  = data[0];
            let Qty     = [];
            let Bulan   = [];

            Object.entries(Result).forEach(entry => {
              const [key, value] = entry;
              Bulan.push(key);
              Qty.push(parseInt(value));
            });

            var linechartBasicColors = getChartColorsArray("stacked-column-chart");
            linechartBasicColors &&
            ((options = {
              chart: { 
                height: 360, 
                type: "bar", 
                stacked: !0, 
                toolbar: 
                { 
                  show: !1 
                }, 
                zoom: { 
                  enabled: !0 
                } 
              },
              plotOptions: { bar: { horizontal: !1, columnWidth: "15%", endingShape: "rounded" } },
              dataLabels: { enabled: !1 },
              series: [
                { name: "Total Pelamar", data: Qty }
              ],
              xaxis: { categories: Bulan },
              colors: linechartBasicColors,
              legend: { position: "bottom" },
              fill: { opacity: 1 },
            }),
            (chart = new ApexCharts(document.querySelector("#stacked-column-chart"), options)).render());

          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
              'Oops...',
              jqXHR.responseJSON.message,
              textStatus
            );
          }
        });
      }

      function check_verification_email() {
        $.ajax({
          data: {
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('home.email-checking') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            if (data.email_verified_at == null) {

              let timerInterval;
              Swal.fire({
                icon: "info",
                title: "Oops...",
                html: "Anda belum melakukan aktivasi akun. Silahkan cek email {{ Auth::user()->email }} yang telah anda daftarkan, periksa inbox atau spam. Anda akan logout otomatis dalam <b></b> milliseconds.",
                timer: 10000,
                allowOutsideClick: false,
                timerProgressBar: true,
                didOpen: () => {
                  Swal.showLoading();
                  const timer = Swal.getPopup().querySelector("b");
                  timerInterval = setInterval(() => {
                    timer.textContent = `${Swal.getTimerLeft()}`;
                  }, 100);
                },
                willClose: () => {
                  clearInterval(timerInterval);
                }
              }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                  //console.log("I was closed by the timer");
                  auto_logout();
                }
              });
            } else {
              console.log("gak");
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
              'Oops...',
              jqXHR.responseJSON.message,
              textStatus
            );
          }
        });
      }

      function auto_logout() {
        $.ajax({
          data: {
            "_token": "{{ csrf_token() }}"
          },
          url: "{{ route('logout') }}",
          type: "POST",
          dataType: "JSON",
          success: function(data) {
            const Urls = "{{ url('/login') }}";
            location.replace(Urls);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            Swal.fire(
              'Oops...',
              jqXHR.responseJSON.message,
              textStatus
            );
          }
        });
      }

      $(document).ready(function() {
        load_grafik_data();
        check_verification_email();
      });
    </script>
  </body>
</html>