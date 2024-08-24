<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\PernyataanController;
use App\Http\Controllers\IdentitaspribadiController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\KontakdaruratController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\SaudaraController;
use App\Http\Controllers\OrangtuaController;
use App\Http\Controllers\CatatantambahanController;
use App\Http\Controllers\TambahansatuController;
use App\Http\Controllers\TambahanduaController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PengalamanController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\HasilpsikotestController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//PSIKOTEST
use App\Http\Controllers\TypesoalController;
use App\Http\Controllers\NamaujianController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\IkutujianController;
use App\Http\Controllers\SessionController;

Route::middleware('guest')->group(function () {
  Route::get('/', [VerifyController::class, 'welcome']);

  Route::get('/email-verification/{hash}/{email}', [VerifyController::class, 'index']);
  Route::get('/faq', [VerifyController::class, 'faq'])->name('home.faq');
  Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

  Route::get('/show-email-template', function () {
    $mailData = array(
      'Name' => 'John Doe',
      'Url' => 'john.doe@example.com'
    );
    return view('emails.sample', $mailData);
  });
});

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('/check-session', [SessionController::class, 'checkSession'])->name('checkSession');

  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::get('/password', [HomeController::class, 'password'])->name('users.password');
  Route::get('/profile', [HomeController::class, 'profile'])->name('users.profile');
  Route::post('/update-password', [HomeController::class, 'update_password'])->name('users.update-password');
  Route::post('/grafik-data', [HomeController::class, 'data_grafik'])->name('home.grafik');
  Route::post('/email-checking', [HomeController::class, 'check_email_verfification'])->name('home.email-checking');
  Route::resource('roles', RoleController::class);
  Route::resource('navigation', NavigationController::class);
  Route::resource('permissions', PermissionController::class);
  Route::resource('users', UserController::class);

  Route::get('/users-create', [UserController::class, 'create'])->name('users.create');
  Route::post('/users-edit', [UserController::class, 'edit'])->name('users.edit');
  Route::post('/users-activated', [UserController::class, 'activated'])->name('user.activated');

  //PSIKOTEST
  //1. TYPE SOAL
  Route::get('/type', [TypesoalController::class, 'index'])->name('type.index');
  Route::get('/type-list', [TypesoalController::class, 'index'])->name('type.index');
  Route::post('/type-save', [TypesoalController::class, 'save'])->name('type.save');
  Route::post('/type-edit', [TypesoalController::class, 'edit'])->name('type.edit');
  Route::post('/type-update', [TypesoalController::class, 'update'])->name('type.update');
  Route::post('/type-hapus', [TypesoalController::class, 'hapus'])->name('type.hapus');
  //2. NAMA UJIAN
  Route::get('/ujian', [NamaujianController::class, 'index'])->name('nama-ujian.index');
  Route::get('/ujian-list', [NamaujianController::class, 'index'])->name('nama-ujian.index');
  Route::post('/ujian-save', [NamaujianController::class, 'save'])->name('nama-ujian.save');
  Route::post('/ujian-edit', [NamaujianController::class, 'edit'])->name('nama-ujian.edit');
  Route::post('/ujian-update', [NamaujianController::class, 'update'])->name('nama-ujian.update');
  Route::post('/ujian-hapus', [NamaujianController::class, 'hapus'])->name('nama-ujian.hapus');
  Route::post('/refresh-pin', [NamaujianController::class, 'refresh_pin'])->name('refresh_pin');
  //3. SOAL
  Route::get('/soal/{id}', [SoalController::class, 'index'])->name('soal.index');
  Route::get('/soal-list/{id}', [SoalController::class, 'index'])->name('soal.index');
  Route::post('/soal-save', [SoalController::class, 'save'])->name('soal.save');
  Route::post('/soal-edit', [SoalController::class, 'edit'])->name('soal.edit');
  Route::post('/soal-update', [SoalController::class, 'update'])->name('soal.update');
  Route::post('/soal-hapus', [SoalController::class, 'hapus'])->name('soal.hapus');
  Route::post('/soal-save-test-warna', [SoalController::class, 'save_test_warna'])->name('soal.save-test-warna');
  Route::post('/soal-update-test-warna', [SoalController::class, 'update_test_warna'])->name('soal.update-test-warna');
  Route::post('/import-soal', [SoalController::class, 'import_soal'])->name('import.soal');

  //4. IKUT UJIAN
  Route::get('/ikuti', [IkutujianController::class, 'index'])->name('ikuti.index');
  Route::get('/ikuti-list', [IkutujianController::class, 'index'])->name('ikuti-list.index');
  Route::post('/ikuti-check-pin', [IkutujianController::class, 'check_pin'])->name('ikuti.check_pin');
  Route::get('/psikotest/ikut/soal/{id}/{pin}', [IkutujianController::class, 'mulai_ujian'])->name('ikuti.mulai-ujian');
  Route::get('/tampilkan-soal-ujian/{id}/{pin}', [IkutujianController::class, 'tampilkan_soal_ujian'])->name('ikuti.tampilkan-soal');
  Route::post('/ikuti-ujian-simpan', [IkutujianController::class, 'simpan_jawaban'])->name('ikuti-ujian.simpan');
  Route::get('/ujian-detail/{id}', [IkutujianController::class, 'ujian_detail'])->name('ujian-detail');
  Route::post('/check-biodata', [IkutujianController::class, 'check_biodata'])->name('check.biodata');
  
  //5. REPORT HASIL PSIKOTEST
  Route::get('/hasil', [HasilpsikotestController::class, 'index'])->name('hasil.index');
  Route::post('/hasil-list', [HasilpsikotestController::class, 'index'])->name('hasil.index');
  Route::post('/hasil-hapus', [HasilpsikotestController::class, 'hapus'])->name('hasil.hapus');

  //PERTANYAAN
  Route::get('/pertanyaan', [PertanyaanController::class, 'index'])->name('pertanyaan.index');
  Route::get('/pertanyaan-list', [PertanyaanController::class, 'index'])->name('pertanyaan.index');
  Route::post('/pertanyaan-listing', [PertanyaanController::class, 'listing'])->name('pertanyaan.listing');
  Route::post('/pertanyaan-save', [PertanyaanController::class, 'save'])->name('pertanyaan.save');
  Route::post('/pertanyaan-edit', [PertanyaanController::class, 'edit'])->name('pertanyaan.edit');
  Route::post('/pertanyaan-update', [PertanyaanController::class, 'update'])->name('pertanyaan.update');
  Route::post('/pertanyaan-hapus', [PertanyaanController::class, 'hapus'])->name('pertanyaan.hapus');
  Route::post('/pertanyaan-dijawab', [PertanyaanController::class, 'dijawab'])->name('pertanyaan.dijawab');

  //PERNYATAAN
  Route::get('/pernyataan', [PernyataanController::class, 'index'])->name('pernyataan.index');
  Route::get('/pernyataan-list', [PernyataanController::class, 'index'])->name('pernyataan.index');
  Route::post('/pernyataan-save', [PernyataanController::class, 'save'])->name('pernyataan.save');
  Route::post('/pernyataan-edit', [PernyataanController::class, 'edit'])->name('pernyataan.edit');
  Route::post('/pernyataan-update', [PernyataanController::class, 'update'])->name('pernyataan.update');
  Route::post('/pernyataan-hapus', [PernyataanController::class, 'hapus'])->name('pernyataan.hapus');

  //IDENTITAS PRIBADI
  Route::get('/identitas', [IdentitaspribadiController::class, 'index'])->name('identitas.index');
  Route::get('/identitas-list', [IdentitaspribadiController::class, 'index'])->name('identitas.index');
  Route::post('/identitas-save', [IdentitaspribadiController::class, 'save'])->name('identitas.save');
  Route::post('/identitas-edit', [IdentitaspribadiController::class, 'edit'])->name('identitas.edit');
  Route::post('/identitas-update', [IdentitaspribadiController::class, 'update'])->name('identitas.update');
  Route::post('/identitas-hapus', [IdentitaspribadiController::class, 'hapus'])->name('identitas.hapus');
  Route::get('/identitas-preview/{id}', [IdentitaspribadiController::class, 'preview'])->name('identitas.preview');
  Route::get('/cetak-pdf/{id}', [IdentitaspribadiController::class, 'cetak'])->name('identitas.cetak');

  //KELUARGA DAN PASANGAN
  Route::get('/keluarga', [KeluargaController::class, 'index'])->name('keluarga.index');
  Route::get('/keluarga-list', [KeluargaController::class, 'index'])->name('keluarga.index');
  Route::post('/keluarga-save', [KeluargaController::class, 'save'])->name('keluarga.save');
  Route::post('/keluarga-edit', [KeluargaController::class, 'edit'])->name('keluarga.edit');
  Route::post('/keluarga-update', [KeluargaController::class, 'update'])->name('keluarga.update');
  Route::post('/keluarga-hapus', [KeluargaController::class, 'hapus'])->name('keluarga.hapus');

  //KONTAK
  Route::get('/kontak', [KontakdaruratController::class, 'index'])->name('kontak.index');
  Route::get('/kontak-list', [KontakdaruratController::class, 'index'])->name('kontak.index');
  Route::post('/kontak-save', [KontakdaruratController::class, 'save'])->name('kontak.save');
  Route::post('/kontak-edit', [KontakdaruratController::class, 'edit'])->name('kontak.edit');
  Route::post('/kontak-update', [KontakdaruratController::class, 'update'])->name('kontak.update');
  Route::post('/kontak-hapus', [KontakdaruratController::class, 'hapus'])->name('kontak.hapus');

  //ANAK
  Route::get('/anak', [AnakController::class, 'index'])->name('anak.index');
  Route::get('/anak-list', [AnakController::class, 'index'])->name('anak.index');
  Route::post('/anak-save', [AnakController::class, 'save'])->name('anak.save');
  Route::post('/anak-edit', [AnakController::class, 'edit'])->name('anak.edit');
  Route::post('/anak-update', [AnakController::class, 'update'])->name('anak.update');
  Route::post('/anak-hapus', [AnakController::class, 'hapus'])->name('anak.hapus');

  //ORANG TUA
  Route::get('/orangtua', [OrangtuaController::class, 'index'])->name('orangtua.index');
  Route::get('/orangtua-list', [OrangtuaController::class, 'index'])->name('orangtua.index');
  Route::post('/orangtua-save', [OrangtuaController::class, 'save'])->name('orangtua.save');
  Route::post('/orangtua-edit', [OrangtuaController::class, 'edit'])->name('orangtua.edit');
  Route::post('/orangtua-update', [OrangtuaController::class, 'update'])->name('orangtua.update');
  Route::post('/orangtua-hapus', [OrangtuaController::class, 'hapus'])->name('orangtua.hapus');

  //SAUDARA
  Route::get('/saudara', [SaudaraController::class, 'index'])->name('saudara.index');
  Route::get('/saudara-list', [SaudaraController::class, 'index'])->name('saudara.index');
  Route::post('/saudara-save', [SaudaraController::class, 'save'])->name('saudara.save');
  Route::post('/saudara-edit', [SaudaraController::class, 'edit'])->name('saudara.edit');
  Route::post('/saudara-update', [SaudaraController::class, 'update'])->name('saudara.update');
  Route::post('/saudara-hapus', [SaudaraController::class, 'hapus'])->name('saudara.hapus');

  //TAMBAHAN SATU LAINNYA
  Route::get('/tambahan', [TambahansatuController::class, 'index'])->name('tambahan.index');
  Route::get('/tambahan-list', [TambahansatuController::class, 'index'])->name('tambahan.index');
  Route::post('/tambahan-save', [TambahansatuController::class, 'save'])->name('tambahan.save');
  Route::post('/tambahan-edit', [TambahansatuController::class, 'edit'])->name('tambahan.edit');
  Route::post('/tambahan-update', [TambahansatuController::class, 'update'])->name('tambahan.update');
  Route::post('/tambahan-hapus', [TambahansatuController::class, 'hapus'])->name('tambahan.hapus');

  //TAMBAHAN DUA LAINNYA
  Route::get('/tambahan-dua', [TambahanduaController::class, 'index'])->name('tambahan-dua.index');
  Route::get('/tambahan-dua-list', [TambahanduaController::class, 'index'])->name('tambahan-dua.index');
  Route::post('/tambahan-dua-save', [TambahanduaController::class, 'save'])->name('tambahan-dua.save');
  Route::post('/tambahan-dua-edit', [TambahanduaController::class, 'edit'])->name('tambahan-dua.edit');
  Route::post('/tambahan-dua-update', [TambahanduaController::class, 'update'])->name('tambahan-dua.update');
  Route::post('/tambahan-dua-hapus', [TambahanduaController::class, 'hapus'])->name('tambahan-dua.hapus');

  //CATATAN TAMBAHAN
  Route::get('/catatan', [CatatantambahanController::class, 'index'])->name('catatan.index');
  Route::get('/catatan-list', [CatatantambahanController::class, 'index'])->name('catatan.index');
  Route::post('/catatan-save', [CatatantambahanController::class, 'save'])->name('catatan.save');
  Route::post('/catatan-edit', [CatatantambahanController::class, 'edit'])->name('catatan.edit');
  Route::post('/catatan-update', [CatatantambahanController::class, 'update'])->name('catatan.update');
  Route::post('/catatan-hapus', [CatatantambahanController::class, 'hapus'])->name('catatan.hapus');

  //UPLOAD DOKUMENT
  Route::get('/dokumen', [DocumentController::class, 'index'])->name('dokumen.index');
  Route::get('/dokumen-list', [DocumentController::class, 'index'])->name('dokumen.index');
  Route::post('/dokumen-save', [DocumentController::class, 'save'])->name('dokumen.save');
  Route::post('/dokumen-edit', [DocumentController::class, 'edit'])->name('dokumen.edit');
  Route::post('/dokumen-update', [DocumentController::class, 'update'])->name('dokumen.update');
  Route::post('/dokumen-hapus', [DocumentController::class, 'hapus'])->name('dokumen.hapus');

  //PENGALAMAN KERJA
  Route::get('/pengalaman', [PengalamanController::class, 'index'])->name('pengalaman.index');
  Route::get('/pengalaman-list', [PengalamanController::class, 'index'])->name('pengalaman.index');
  Route::post('/pengalaman-save', [PengalamanController::class, 'save'])->name('pengalaman.save');
  Route::post('/pengalaman-edit', [PengalamanController::class, 'edit'])->name('pengalaman.edit');
  Route::post('/pengalaman-update', [PengalamanController::class, 'update'])->name('pengalaman.update');
  Route::post('/pengalaman-hapus', [PengalamanController::class, 'hapus'])->name('pengalaman.hapus');

  //MASTER FAQS
  Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
  Route::get('/faqs-list', [FaqController::class, 'index'])->name('faqs.index');
  Route::post('/faqs-save', [FaqController::class, 'save'])->name('faqs.save');
  Route::post('/faqs-edit', [FaqController::class, 'edit'])->name('faqs.edit');
  Route::post('/faqs-update', [FaqController::class, 'update'])->name('faqs.update');
  Route::post('/faqs-hapus', [FaqController::class, 'hapus'])->name('faqs.hapus');

  //REPORT
  Route::get('/report', [ReportController::class, 'index'])->name('report.index');
  Route::post('/report-list', [ReportController::class, 'list'])->name('report.list');
  Route::post('/report-document-list', [ReportController::class, 'document_list'])->name('report.document-list');
  Route::post('/report-hapus-all', [ReportController::class, 'hapus_semua_data_user'])->name('report.hapus-all');
});