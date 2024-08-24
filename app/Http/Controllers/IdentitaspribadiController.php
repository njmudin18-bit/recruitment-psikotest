<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentitaspribadiModel;
use App\Models\User;
use App\Models\SaudaraModel;
use App\Models\TambahansatuModel;
use App\Models\DocumentModel;
use App\Services\PernyataanService;
use App\Services\IdentitaspribadiService;
use App\Services\CatatantambahanService;
use App\Services\PasanganService;
use App\Services\KontakService;
use App\Services\AnakService;
use App\Services\SaudaraService;
use App\Services\OrangtuaService;
use App\Services\TambahanduaService;
use App\Services\TambahansatuService;
use App\Services\PertanyaanService;
use App\Services\DocumentService;
use App\Services\PengalamanService;
use Validator;
use Auth;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
//use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Arr;

class IdentitaspribadiController extends Controller
{
  protected $identitaspribadiService;
  protected $pernyataanService;
  protected $catatantambahanService;
  protected $pasanganService;
  protected $kontakService;
  protected $anakService;
  protected $saudaraService;
  protected $orangtuaService;
  protected $tambahansatuService;
  protected $tambahanduaService;
  protected $pertanyaanService;
  protected $documentService;
  protected $pengalamanService;

  public function __construct(IdentitaspribadiService $identitaspribadiService, PernyataanService $pernyataanService,
  CatatantambahanService $catatantambahanService, PasanganService $pasanganService, KontakService $kontakService,
  AnakService $anakService, SaudaraService $saudaraService, OrangtuaService $orangtuaService,
  TambahansatuService $tambahansatuService, TambahanduaService $tambahanduaService,
  PertanyaanService $pertanyaanService, DocumentService $documentService, PengalamanService $pengalamanService)
  {
    $this->middleware('can:read identitas');
    $this->identitaspribadiService  = $identitaspribadiService;
    $this->pernyataanService        = $pernyataanService;
    $this->catatantambahanService   = $catatantambahanService;
    $this->pasanganService          = $pasanganService;
    $this->kontakService            = $kontakService;
    $this->anakService              = $anakService;
    $this->saudaraService           = $saudaraService;
    $this->orangtuaService          = $orangtuaService;
    $this->tambahansatuService      = $tambahansatuService;
    $this->tambahanduaService       = $tambahanduaService;
    $this->pertanyaanService        = $pertanyaanService;
    $this->documentService          = $documentService;
    $this->pengalamanService        = $pengalamanService;
  }

  public function index(Request $request)
  {
    //dd(Auth::user()->roles[0]->name); //PAKE INI UNTUK USER PELAMAR
    $Title      = "Pelamar";
    $SubTitle   = "Identitas Pribadi";
    if ($request->ajax()) {
      return $this->identitaspribadiService->dataTable();
    }

    return view('identitas.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Department'            => 'required|string',
      'Posisi'                => 'required|string',
      'SumberInfo'            => 'required|string',
      'GajiDiminta'           => 'required|string|max:16',
      'Nama'                  => 'required|string',
      'TempatLahir'           => 'required|string',
      'TanggalLahir'          => 'required|string',
      'Jk'                    => 'required|string',
      'StatusNikah'           => 'required|string',
      'NoKtp'                 => 'required|string',
      'AlamatKtp'             => 'required|string',
      'AlamatRumahTinggal'    => 'required|string',
      'StatusKepemilikan'     => 'required|string',
      'NoHp'                  => 'required|numeric',
      'Email'                 => 'required|email',
      'Sosmed'                => 'required|string',
      'Kewarganegaraan'       => 'required|string',
      'Agama'                 => 'required|string',
      'BeratBadan'            => 'required|numeric',
      'TinggiBadan'           => 'required|numeric',
      'GolDarah'              => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $result = $this->identitaspribadiService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->identitaspribadiService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Department'            => 'required|string',
      'Posisi'                => 'required|string',
      'SumberInfo'            => 'required|string',
      'GajiDiminta'           => 'required|string|max:16',
      'Nama'                  => 'required|string',
      'TempatLahir'           => 'required|string',
      'TanggalLahir'          => 'required|string',
      'Jk'                    => 'required|string',
      'StatusNikah'           => 'required|string',
      'NoKtp'                 => 'required|string',
      'AlamatKtp'             => 'required|string',
      'AlamatRumahTinggal'    => 'required|string',
      'StatusKepemilikan'     => 'required|string',
      'NoHp'                  => 'required|numeric',
      'Email'                 => 'required|email',
      'Sosmed'                => 'required|string',
      'Kewarganegaraan'       => 'required|string',
      'Agama'                 => 'required|string',
      'BeratBadan'            => 'required|numeric',
      'TinggiBadan'           => 'required|numeric',
      'GolDarah'              => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $result = $this->identitaspribadiService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->identitaspribadiService->destroy($Id);

    return response()->json($result);
  }

  public function preview($id) {
    //dd(Auth::user()->id);
    $Title        = "Pelamar";
    $SubTitle     = "Preview Identitas Pribadi";
    $Pernyataan   = $this->pernyataanService->show();
    $Identitas    = $this->identitaspribadiService->showByUser($id);
    $Catatan      = $this->catatantambahanService->showByUser($id);
    $Pasangan     = $this->pasanganService->showByUser($id);
    $Kontak       = $this->kontakService->showByUser($id);
    $Anak         = $this->anakService->showByUser($id);
    $Saudara      = $this->saudaraService->showByUser($id);
    $Orangtua     = $this->orangtuaService->showByUser($id);
    $Tambahansatu = $this->tambahansatuService->showByUser($id);
    $Tambahandua  = $this->tambahanduaService->showByUser($id);
    $Pertanyaan   = $this->pertanyaanService->showByUser($id);
    $Pengalaman   = $this->pengalamanService->showByUser($id);
    $Dokumen      = DocumentModel::where('CreatedBy', $id)->get();
    $PasFoto      = $Dokumen->where('TypeDokumen', 'Foto')->first();
    $ArrayDoc     = array(
      'DocLamaran'  => $Dokumen->where('TypeDokumen', 'Lamaran')->count(),
      'DocCV'       => $Dokumen->where('TypeDokumen', 'CV')->count(),
      'DocKTP'      => $Dokumen->where('TypeDokumen', 'KTP')->count(),
      'DocNPWP'     => $Dokumen->where('TypeDokumen', 'NPWP')->count(),
      'DocIjazah'   => $Dokumen->where('TypeDokumen', 'Ijazah')->count(),
      'DocSKCK'     => $Dokumen->where('TypeDokumen', 'SKCK')->count(),
      'DocKK'       => $Dokumen->where('TypeDokumen', 'KK')->count(),
      'DocDokter'   => $Dokumen->where('TypeDokumen', 'Dokter')->count(),
      'DocVaksin'   => $Dokumen->where('TypeDokumen', 'Vaksin')->count(),
      'DocFoto'     => $Dokumen->where('TypeDokumen', 'Foto')->count()
    );

    //dd($PasFoto);
    //dd($PasFoto->File);

    return  view('identitas.preview', 
            compact('Title', 'SubTitle', 'Pernyataan', 'Catatan', 'PasFoto',
                    'Identitas', 'Pasangan', 'Kontak', 'Anak', 'Saudara', 'Pengalaman',
                    'Orangtua', 'Tambahansatu', 'Tambahandua', 'Pertanyaan', 'ArrayDoc'));
  }

  public function cetak($id)
  {
    $Title        = "Pelamar";
    $SubTitle     = "Preview Identitas Pribadi";
    $Pernyataan   = $this->pernyataanService->show();
    $Identitas    = $this->identitaspribadiService->showByUser($id);
    $Catatan      = $this->catatantambahanService->showByUser($id);
    $Pasangan     = $this->pasanganService->showByUser($id);
    $Kontak       = $this->kontakService->showByUser($id);
    $Anak         = $this->anakService->showByUser($id);
    $Saudara      = $this->saudaraService->showByUser($id);
    $Orangtua     = $this->orangtuaService->showByUser($id);
    $Tambahansatu = $this->tambahansatuService->showByUser($id);
    $Tambahandua  = $this->tambahanduaService->showByUser($id);
    $Pertanyaan   = $this->pertanyaanService->showByUser($id);
    // //$Dokumen      = $this->documentService->showByUser();
    $Dokumen      = DocumentModel::where('CreatedBy', $id)->get();
    $ArrayDoc     = array(
      'DocLamaran'  => $Dokumen->where('TypeDokumen', 'Lamaran')->count(),
      'DocCV'       => $Dokumen->where('TypeDokumen', 'CV')->count(),
      'DocKTP'      => $Dokumen->where('TypeDokumen', 'KTP')->count(),
      'DocNPWP'     => $Dokumen->where('TypeDokumen', 'NPWP')->count(),
      'DocIjazah'   => $Dokumen->where('TypeDokumen', 'Ijazah')->count(),
      'DocSKCK'     => $Dokumen->where('TypeDokumen', 'SKCK')->count(),
      'DocKK'       => $Dokumen->where('TypeDokumen', 'KK')->count(),
      'DocDokter'   => $Dokumen->where('TypeDokumen', 'Dokter')->count(),
      'DocVaksin'   => $Dokumen->where('TypeDokumen', 'Vaksin')->count()
    );

    $data = [
            'title' => 'My Awesome PDF Report',
            'content' => 'This is the content to be included in the PDF.',
            // ... other data
        ];

        $pdf = Pdf::loadView('identitas.cetak', compact('Title', 'SubTitle', 'data', 'Identitas', 
                                                    'Pasangan', 'Kontak', 'Anak', 'Orangtua', 
                                                    'Saudara', 'Tambahansatu', 'Tambahandua', 
                                                    'Pertanyaan', 'Pernyataan', 'Catatan', 'ArrayDoc'));
        return $pdf->download();

    // Generate HTML with Blade and Bootstrap CSS
    // $html = View::make('identitas.preview', compact('Title', 'SubTitle', 'data', 'Identitas', 
    //                                                 'Pasangan', 'Kontak', 'Anak', 'Orangtua', 
    //                                                 'Saudara', 'Tambahansatu', 'Tambahandua', 
    //                                                 'Pertanyaan', 'Pernyataan', 'Catatan', 'ArrayDoc'));
    //dd($html);
    // Create PDF with dompdf
    //$pdf = PDF::loadView($html);

    // Optionally set PDF options (refer to dompdf documentation)
    //$pdf->setPaper('letter', 'portrait'); // Adjust paper size and orientation
    //$pdf->setOptions(['dpi' => 200, 'enable-local-files' => true]); // Adjust DPI and enable local files

    // Optionally include custom header and footer HTML:
    // if (View::exists('pdf-header')) {
    //     $pdf->setOption('header-html', View::make('pdf-header'));
    // }
    // if (View::exists('pdf-footer')) {
    //     $pdf->setOption('footer-html', View::make('pdf-footer'));
    // }

    // Return PDF response (or save to a file)
    //return $pdf->stream('my-awesome-report.pdf'); // Inline download

    // To save to a file:
    // $pdf->save(storage_path('app/public/reports/my-awesome-report.pdf'));
    // return redirect()->route('reports.index'); // Redirect after saving
  }
}
