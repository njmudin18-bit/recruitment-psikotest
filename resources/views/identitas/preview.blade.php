<!doctype html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $SubTitle }} | {{ config('appsproperties.APPS_NAME') }}</title>
    <x-meta-header :subtitle="$SubTitle"></x-metas>
    <x-css-standard></x-css-standard>
    <style>
      .form-check-input:disabled {
        opacity: 1;
      }

      .invoice-title p {
        margin-bottom: 0rem;
        line-height: 20px;
      }

      .form-check-input:disabled~.form-check-label, .form-check-input[disabled]~.form-check-label {
        opacity: 1;
      }

      .text-dark {
        color: #000 !important;
      }

      .row.border-bottom {
        border-bottom: 1px solid #000 !important;
      }

      .icon-text {
        display: flex;
        align-items: center; /* Align icon and text vertically */
        gap: 0px; /* Adjust spacing between icon and text */
        font-weight: 500;
      }

      .icon-text i {
        margin-right: 5px; /* Adjust spacing between icon and text */
      }

      @media print {
        body {
          font-size: 9pt; /* Set your desired font size in points (pt) */
        }
      }
    </style>
  </head>
  <body data-sidebar="dark" data-layout-mode="light">
    <div id="layout-wrapper">
      <x-top-bar />

      <x-left-side-bar />

      <div class="main-content">
        <div class="page-content">
          <div class="container-fluid">
            <!-- start page title -->
            <x-page-title :title="$Title" :subtitle="$SubTitle" />
            <!-- end page title -->

            <div class="row mb-3 d-print-none">
              <div class="float-start">
                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print me-1"></i> Cetak</a>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div id="page" class="container p-3">
                      <!-- <form class="form"> -->
                        <div class="invoice-title">
                          <div class="row border-bottom">
                            <div class="col-md-3 text-center justify-content-center mt-3">
                              <img id="logo" src="{{ asset(config('appsproperties.COMPANY_LOGO')) }}" width="140" height="auto" />
                            </div>
                            <div class="col-md-7">
                              <h4 class="text-start text-dark">{{ strtoupper(config('appsproperties.COMPANY_NAME')) }}</h4>
                              <p class="text-start text-dark">Alamat: {{ config('appsproperties.COMPANY_ADDRESS') }}</p>
                              <p class="text-start text-dark mb-3">Email: {{ config('appsproperties.COMPANY_EMAIL') }}, Telp. {{ config('appsproperties.COMPANY_PHONE') }}</p>
                            </div>
                            <div class="col-md-2 text-center">
                              @if(!empty($PasFoto))
                                <img src="{{ url('/') }}/{{ $PasFoto->File }}" alt="{{ $Identitas->Nama }}" class="avatar-md rounded">
                              @endif
                            </div>
                          </div>
                        </div>
                        <div class="row mt-3">
                          <div class="col-sm-12">
                            <h4 class="text-center text-with-border text-dark"><strong>FORMULIR APLIKASI PELAMAR</strong></h4>
                            <!-- <span class="text-center"></span> -->
                          </div>
                        </div>
                        <div class="row mt-1">
                          <label class="col-sm-3 col-form-label text-dark">Posisi/ Jabatan<span class="float-end">:</span></label>
                          <label class="col-sm-3 col-form-label text-capitalize text-dark">{{ $Identitas->Posisi }}</label>
                          <label class="col-sm-3 col-form-label text-dark">Sumber informasi<span class="float-end">:</span></label>
                          <label class="col-sm-3 col-form-label text-capitalize text-dark">{{ $Identitas->SumberInfo }}</label>
                        </div>
                        <div class="row">
                          <label class="col-sm-3 col-form-label text-dark">Department<span class="float-end">:</span></label>
                          <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->Department }}</label>
                          <label class="col-sm-3 col-form-label text-dark">Gaji yang diminta<span class="float-end">:</span></label>
                          <label class="col-sm-3 col-form-label text-dark">Rp. {{ number_format($Identitas->GajiDiminta, 0) }}</label>
                        </div>
                        <!-- A. IDENTITAS PRIBADI -->
                        <div class="row mt-3 mb-3">
                          <div class="col-md-12">
                            <h5 class="text-dark"><strong>A. IDENTITAS PRIBADI</strong></h5>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Nama lengkap<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Identitas->Nama }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Tempat & tgl lahir<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Identitas->TempatLahir }}, {{ strftime('%d %B %Y', strtotime($Identitas->TanggalLahir)) }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Jenis kelamin<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->Jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Status pernikahan<span class="float-end">:</span></label>
                              @if ($Identitas->StatusNikah == 'BK')
                              <label class="col-sm-3 col-form-label text-dark">Belum Kawin</label>
                              @elseif ($Identitas->StatusNikah == 'K')
                              <label class="col-sm-3 col-form-label text-dark">Kawin</label>
                              @elseif ($Identitas->StatusNikah == 'CH')
                              <label class="col-sm-3 col-form-label text-dark">Cerai Hidup</label>
                              @else
                              <label class="col-sm-3 col-form-label text-dark">Cerai Mati</label>
                              @endif
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Nomor KTP<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Identitas->NoKtp }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Alamat KTP<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Identitas->AlamatKtp }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Alamat rumah tinggal<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Identitas->AlamatRumahTinggal }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Status tempat tinggal<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->StatusKepemilikan }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Nomor telepon<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->NoHp }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Email<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->Email }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Kewarganegaraan<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->Kewarganegaraan }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Agama<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->Agama }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Berat dan tinggi badan<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->BeratBadan }} kg dan {{ $Identitas->TinggiBadan }} cm</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Gol. Darah dan Vaksin<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->GolDarah }} dan {{ $Identitas->Vaksin == '' ? '-' : $Identitas->Vaksin }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Alergi<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Identitas->Alergi == '' ? '-' : $Identitas->Alergi }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Akun sosial media<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Identitas->Sosmed == '' ? '-' : $Identitas->Sosmed }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Pengobatan saat ini<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Identitas->Pengobatan == '' ? '-' : $Identitas->Pengobatan }}</label>
                            </div>
                          </div>
                        </div>

                        <!-- B. KELUARGA DAN LINGKUNGAN -->
                        <div class="row mt-3 mb-3">
                          <div class="col-md-12">
                            <h5 class="text-dark"><strong>B. KELUARGA DAN LINGKUNGAN</strong></h5>
                          </div>
                          <!-- PASANGAN -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>1. Data pasangan <span class="fst-italic">(Suami/ Istri)</span></strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Nama lengkap<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->NamaPasangan }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Tempat & tgl lahir<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->TempatLahir }}, {{ $Pasangan == null ? '-' : strftime('%d %B %Y', strtotime($Pasangan->TanggalLahir)) }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Alamat KTP<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->AlamatKtp }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Pendidikan<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->Pendidikan }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Pekerjaan<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->Pekerjaan }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Nama perusahaan<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->Perusahaan }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Posisi/ Jabatan<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->Jabatan }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Nomor telepon<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->NoHp }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Email<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->Email }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Akun sosial media<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Pasangan == null ? '-' : $Pasangan->Sosmed }}</label>
                            </div>
                          </div>
                          <!-- KONTAK -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>2. Data kontak darurat</strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Nama<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Kontak == null ? '-' : $Kontak->Nama }}</label>
                              <label class="col-sm-3 col-form-label text-dark">Hubungan<span class="float-end">:</span></label>
                              <label class="col-sm-3 col-form-label text-dark">{{ $Kontak == null ? '-' : $Kontak->Hubungan }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Telepon<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Kontak == null ? '-' : $Kontak->NoHp }}</label>
                            </div>
                            <div class="row">
                              <label class="col-sm-3 col-form-label text-dark">Alamat<span class="float-end">:</span></label>
                              <label class="col-sm-9 col-form-label text-dark">{{ $Kontak == null ? '-' : $Kontak->Alamat }}</label>
                            </div>
                          </div>
                          <!-- ANAK -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>3. Data anak</strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered border-dark" width="100%">
                                    <thead>
                                      <tr class="table-light text-center border-dark text-dark">
                                        <th width="5%">No</th>
                                        <th>Nama Anak</th>
                                        <th width="5%">JK</th>
                                        <th>Tempat, tanggal lahir</th>
                                        <th width="15%">Pendidikan</th>
                                        <th>Pekerjaan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if (count($Anak) > 0)
                                        @foreach ($Anak as $key => $item)
                                        <tr>
                                          <td class="text-end text-dark">{{ $key+1 }}</td>
                                          <td class="text-start text-dark">{{ $item->Nama }}</td>
                                          <td class="text-center text-dark">{{ $item->Jk }}</td>
                                          <td class="text-start text-dark">{{ $item->TempatLahir }}, {{ strftime('%d %B %Y', strtotime($item->TanggalLahir)) }}</td>
                                          <td class="text-center text-dark">{{ $item->Pendidikan }}</td>
                                          <td class="text-start text-dark">{{ $item->Pekerjaan }}</td>
                                        </tr>
                                        @endforeach
                                      @else
                                        <tr>
                                          <td colspan="6" class="text-center text-dark">Data belum dilengkapi</td>
                                        </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- ORANG TUA -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>4. Data orang tua <span class="fst-italic">(Ayah dan Ibu)</span></strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered border-dark" width="150%">
                                    <thead>
                                      <tr class="table-light text-center border-dark text-dark">
                                        <th width="5%">No</th>
                                        <th width="25%">Nama</th>
                                        <th width="5%">JK</th>
                                        <th width="25%">Tempat, tanggal lahir</th>
                                        <th width="10%">Pendidikan</th>
                                        <th width="15%">Pekerjaan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if (count($Orangtua) > 0)
                                        @foreach ($Orangtua as $key => $item)
                                        <tr>
                                          <td class="text-end text-dark" rowspan="2">{{ $key+1 }}</td>
                                          <td class="text-start text-dark">{{ $item->Nama }}</td>
                                          <td class="text-center text-dark">{{ $item->Jk }}</td>
                                          <td class="text-start text-dark">{{ $item->TempatLahir }}, {{ strftime('%d %B %Y', strtotime($item->TanggalLahir)) }}</td>
                                          <td class="text-center text-dark">{{ $item->Pendidikan }}</td>
                                          <td class="text-start text-dark">{{ $item->Pekerjaan }}</td>
                                        </tr>
                                        <tr>
                                          <td class="text-dark" colspan="5"><strong>Alamat</strong> {{ $item->Alamat }}</td>
                                        </tr>
                                        @endforeach
                                      @else
                                        <tr>
                                          <td colspan="6" class="text-center">Data belum dilengkapi</td>
                                        </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- SAUDARA -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>5. Data saudara kandung <span class="fst-italic">(Kakak dan Adik)</span></strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered border-dark" width="100%">
                                    <thead>
                                      <tr class="table-light text-center border-dark">
                                        <th width="5%">No</th>
                                        <th>Nama</th>
                                        <th width="5%">JK</th>
                                        <th>Tempat, tanggal lahir</th>
                                        <th width="10%">Pendidikan</th>
                                        <th>Pekerjaan</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if (count($Saudara) > 0)
                                        @foreach ($Saudara as $key => $item)
                                        <tr>
                                          <td class="text-end text-dark">{{ $key+1 }}</td>
                                          <td class="text-start text-dark">{{ $item->Nama }}</td>
                                          <td class="text-center text-dark">{{ $item->Jk }}</td>
                                          <td class="text-start text-dark">{{ $item->TempatLahir }}, {{ strftime('%d %B %Y', strtotime($item->TanggalLahir)) }}</td>
                                          <td class="text-center text-dark">{{ $item->Pendidikan }}</td>
                                          <td class="text-start text-dark">{{ $item->Pekerjaan }}</td>
                                        </tr>
                                        @endforeach
                                      @else
                                        <tr>
                                          <td colspan="6" class="text-center text-dark">Data belum dilengkapi</td>
                                        </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- C. TAMBAHAN SAYA LAINNYA -->
                        <div class="row mt-3 mb-3">
                          <div class="col-md-12">
                            <h5 class="text-dark"><strong>C. TAMBAHAN SAYA LAINNYA</strong></h5>
                          </div>
                          <!-- PENGALAMAN KERJA -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>1. Pengalaman Kerja.</strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered border-dark" width="100%">
                                    <thead>
                                      <tr class="table-light text-center border-dark text-dark">
                                        <th width="5%">No</th>
                                        <th width="20%">Nama Perusahaan</th>
                                        <th width="15%">Posisi</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Selesai</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if (count($Pengalaman) > 0)
                                        @foreach ($Pengalaman as $key => $item)
                                        <tr>
                                          <td class="text-end text-dark" rowspan="2">{{ $key+1 }}</td>
                                          <td class="text-start text-dark">{{ $item->Perusahaan }}</td>
                                          <td class="text-start text-dark">{{ $item->Posisi }}</td>
                                          <td class="text-center text-dark">{{ strftime('%d %B %Y', strtotime($item->StartDate)) }}</td>
                                          <td class="text-center text-dark">{{ strftime('%d %B %Y', strtotime($item->EndDate)) }}</td>
                                        </tr>
                                        <tr>
                                          <td colspan="4" class="text-dark">
                                            <strong>Job Deskripsi</strong><br>
                                            {!! $item->JobDesc !!}
                                          </td>
                                        </tr>
                                        @endforeach
                                      @else
                                        <tr>
                                          <td colspan="6" class="text-center text-dark">Data belum dilengkapi</td>
                                        </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- KETERAMPILAN -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>2. Keterampilan, Bahasa, Olahraga, Keorganisasian dll. yang pernah diikuti.</strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered border-dark" width="100%">
                                    <thead>
                                      <tr class="table-light text-center border-dark text-dark">
                                        <th width="5%">No</th>
                                        <th>Keterangan</th>
                                        <th width="15%">Waktu</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if (count($Tambahansatu) > 0)
                                        @foreach ($Tambahansatu as $key => $item)
                                        <tr>
                                          <td class="text-end text-dark">{{ $key+1 }}</td>
                                          <td class="text-start text-dark">{!! $item->Keterangan !!}</td>
                                          <td class="text-center text-dark">{{ strftime('%d %B %Y', strtotime($item->Waktu)) }}</td>
                                        </tr>
                                        @endforeach
                                      @else
                                        <tr>
                                          <td colspan="3" class="text-center text-dark">Data belum dilengkapi</td>
                                        </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- PENDIDIKAN NON FORMAL -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>3. Pendidikan, pengembangan lain yang sedang atau akan dilakukan dalam 2 tahun mendatang.</strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered border-dark" width="100%">
                                    <thead>
                                      <tr class="table-light text-center border-dark text-dark">
                                        <th width="5%">No</th>
                                        <th width="25%">Nama Instansi</th>
                                        <th>Keterangan</th>
                                        <th width="15%">Waktu</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if (count($Tambahandua) > 0)
                                        @foreach ($Tambahandua as $key => $item)
                                        <tr>
                                          <td class="text-end text-dark">{{ $key+1 }}</td>
                                          <td class="text-start text-dark">{{ $item->NamaInstansi }}</td>
                                          <td class="text-start text-dark">{!! $item->Keterangan !!}</td>
                                          <td class="text-center text-dark">{{ strftime('%d %B %Y', strtotime($item->Waktu)) }}</td>
                                        </tr>
                                        @endforeach
                                      @else
                                        <tr>
                                          <td colspan="3" class="text-center text-dark">Data belum dilengkapi</td>
                                        </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- PERTANYAAN LAINNYA -->
                          <div class="col-md-12 mt-3">
                            <h6 class="text-dark"><strong>4. Pertanyaan lainnya.</strong></h6>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="table-responsive">
                                  <table class="table table-bordered border-dark" width="100%">
                                    <thead>
                                      <tr class="table-light text-center border-dark text-dark">
                                        <th rowspan="2" width="5%">No</th>
                                        <th colspan="2" width="15%">Jawaban</th>
                                        <th rowspan="2" width="50%">Pertanyaan</th>
                                      </tr>
                                      <tr class="table-light text-center border-dark text-dark">
                                        <th width="5%">Ya</th>
                                        <th width="5%">Tidak</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @php
                                      $No = 1;
                                      @endphp
                                      @if (count($Pertanyaan) > 0)
                                        @foreach ($Pertanyaan as $key => $item)
                                        @php
                                          $CheckedYa    = $item->Jawaban == 'Ya' ? '<i class="bx bx-check text-dark" style="font-size: 28px;"></i>' : '';
                                          $CheckedTidak = $item->Jawaban == 'Tidak' ? '<i class="bx bx-check text-dark" style="font-size: 28px;"></i>' : '';
                                        @endphp
                                        <tr>
                                          <td class="text-end text-dark">{{ $No }}</td>
                                          <td class="text-center text-dark">
                                            {!! $CheckedYa !!}
                                          </td>
                                          <td class="text-center text-dark">
                                            {!! $CheckedTidak !!}
                                          </td>
                                          <td class="text-start text-dark">
                                            {{ $item->Pertanyaan }}
                                            <br><br>
                                            <strong>Penjelasan: </strong> {{ $item->Penjelasan }}
                                          </td>
                                        </tr>
                                        @php
                                        $No++;
                                        @endphp
                                        @endforeach
                                      @else
                                        <tr>
                                          <td colspan="4" class="text-dark">Pertanyaan belum ada</td>
                                        </tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- D. CATATAN TAMBAHAN -->
                        <div class="row mt-3 mb-3">
                          <div class="col-md-12">
                            <h5 class="text-dark"><strong>D. CATATAN TAMBAHAN</strong></h5>
                          </div>
                          <div class="col-md-12 mt-3">
                            {!! $Catatan == null ? '-' : $Catatan->Keterangan !!}
                          </div>
                        </div>
                        
                        <!-- E. CATATAN DARI HRD PERUSAHAAN -->
                        <div class="row mt-3 mb-3">
                          <div class="col-md-12">
                            <h5 class="text-dark"><strong>E. CATATAN DARI HRD PERUSAHAAN</strong></h5>
                          </div>
                          <div class="col-md-12 mt-3">
                            <div class="row border-bottom">
                              <label class="col-sm-8 col-form-label text-dark"><strong>Interview 1 dilakukan oleh:</strong></label>
                              <label class="col-sm-4 col-form-label text-dark"><strong>Tgl dan Jam:</strong></label>
                              <label class="col-sm-12 col-form-label text-dark mb-5">Catatan:</label>
                            </div>
                            <div class="row mt-2 border-bottom">
                              <label class="col-sm-8 col-form-label text-dark"><strong>Interview 2 dilakukan oleh:</strong></label>
                              <label class="col-sm-4 col-form-label text-dark"><strong>Tgl dan Jam:</strong></label>
                              <label class="col-sm-12 col-form-label text-dark mb-5">Catatan:</label>
                            </div>
                            <div class="row mt-2 border-bottom">
                              <label class="col-sm-8 col-form-label text-dark"><strong>Test-test internal yang dilakukan:</strong></label>
                              <label class="col-sm-4 col-form-label text-dark"><strong>Tanggal dan hasil test:</strong></label>
                              <label class="col-sm-6 col-form-label text-dark">1:</label>
                              <label class="col-sm-6 col-form-label text-dark">3:</label>
                              <label class="col-sm-6 col-form-label text-dark">2:</label>
                              <label class="col-sm-6 col-form-label text-dark">4:</label>
                            </div>
                            <div class="row mt-2 border-bottom">
                              <label class="col-sm-12 col-form-label text-dark"><strong>Lampiran lainnya:</strong></label>
                              <div class="row mt-2 mb-3">
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocLamaran'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> Surat Lamaran
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> Surat Lamaran
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocCV'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> CV
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> CV
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocKTP'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> KTP
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> KTP
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocNPWP'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> NPWP
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> NPWP
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocIjazah'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> Ijazah
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> Ijazah
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocSKCK'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> SKCK
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> SKCK
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocKK'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> Kartu Keluarga
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> Kartu Keluarga
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocDokter'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> Surat Dokter
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> Surat Dokter
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocVaksin'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> Surat Vaksin
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> Surat Vaksin
                                    </span>
                                  @endif
                                </div>
                                <div class="col-md-2 mb-2">
                                  @if ($ArrayDoc['DocFoto'] > 0)
                                    <span class="icon-text">
                                      <i class="bx bx-check-square" style="font-size: 18px;"></i> Pas Foto
                                    </span>
                                  @else
                                    <span class="icon-text">
                                      <i class="bx bx-checkbox" style="font-size: 21px;"></i> Pas Foto
                                    </span>
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- F. PERNYATAAN -->
                        <div class="row mt-3 mb-3">
                          <div class="col-md-12">
                            <h5 class="text-dark"><strong>F. PERNYATAAN</strong></h5>
                          </div>
                          <div class="col-md-12 mt-3">
                            <ol>
                              @foreach ($Pernyataan as $item)
                                <li class="mb-3 text-dark">{{ $item->Pernyataan }}</li>
                              @endforeach
                            </ol>
                            <div class="row">
                              <div class="col-md-4"></div>
                              <div class="col-md-4"></div>
                              <div class="col-md-4 text-center">
                                <h6 class="text-dark">........................., {{ strftime('%d %B %Y', strtotime(date('Y-m-d'))) }}</h6>
                                <br><br>
                                <p class="text-dark">ttd</p>
                                <br><br>
                                <h6 class="text-dark">( {{ $Identitas->Nama }} )</h6>
                              </div>
                            </div>
                          </div>
                        </div>
                        <br><br>
                      <!-- </form> -->
                    </div>

                    <div class="d-print-none">
                      <div class="float-start">
                        <!-- <button id="btn" class="btn btn-danger"><i class="fa fa-print me-1"></i> Generate PDF</button> -->
                        <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print me-1"></i> Cetak</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end row -->
          </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        
        <!-- Footer start -->
        <x-footer-bar />
        <!-- Footer end -->
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

    <!-- Datatable start -->
    <x-loader-component></x-loader-component>
    <!-- Datatable end -->
    
    <script src="{{ asset('assets/js/app.js') }}"></script>    
    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspdf-html2canvas@latest/dist/jspdf-html2canvas.min.js"></script>
    <script>
      $(document).ready(function () {
        $("#loading").hide();

        // let btn           = document.getElementById('btn');
        // let page          = document.getElementById('page');
        // let PDFOutput     = "Identitas Pribadi {{ $Identitas->Nama }}.pdf";
        // let IMGWaterMark  = "{{ asset(config('appsproperties.APPS_ICON_MAS')) }}";

        // btn.addEventListener('click', function(){
        //   html2PDF(page, {
        //     jsPDF: {
        //       unit: 'pt',
        //       format: 'a4',
        //     },
        //     html2canvas: {
        //       imageTimeout: 1000,
        //       logging: true,
        //       useCORS: false,
        //     },
        //     imageType: 'image/jpeg',
        //     imageQuality: 1,
        //     margin: {
        //       top: 20,
        //       right: 10,
        //       bottom: 50,
        //       left: 10,
        //     },
        //     //watermark: undefined,
        //     watermark({ pdf, pageNumber, totalPageNumber }) {
        //       // pdf: jsPDF instance
        //       pdf.setTextColor('#ddd');
        //       pdf.text(50, pdf.internal.pageSize.height - 30, `Aplikasi e-Recruitment PT Multi Arta Sekawan, page: ${pageNumber}/${totalPageNumber}`);
        //     },
        //     autoResize: false,
        //     output: PDFOutput,
        //     init: function() {},
        //     success: function(pdf) {
        //       pdf.save(this.output);
        //     }
        //   });
        // });

      });
    </script>
  </body>
</html>
