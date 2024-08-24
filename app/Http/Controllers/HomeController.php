<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\IdentitaspribadiModel;
use App\Models\DocumentModel;
use App\Models\PasanganModel;
use App\Models\KontakdaruratModel;
use App\Models\AnakModel;
use App\Models\OrangtuaModel;
use App\Models\SaudaraModel;
use App\Models\TambahansatuModel;
use App\Models\TambahanduaModel;
use App\Models\JawabanpertanyaanModel;
use App\Models\CatatantambahanModel;
use App\Models\PengalamanModel;
use App\Services\UserService;
use App\Services\IdentitaspribadiService;
use Auth;
use Illuminate\Support\Arr;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $userService;
    protected $identitaspribadiService;

    public function __construct(UserService $userService, IdentitaspribadiService $identitaspribadiService)
    {
      $this->middleware('auth');
      $this->userService              = $userService;
      $this->identitaspribadiService  = $identitaspribadiService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //dd();
      //dd(Auth::user()->roles[0]->name);
      $Title          = "Dashboard";
      $SubTitle       = "Dashboard";
      $User           = auth()->user();
      //dd($User->email_verified_at);
      $Id             = Auth::user()->id;
      $Identitas      = IdentitaspribadiModel::where('CreatedBy', $Id)->count();
      $IdentitasDiri  = IdentitaspribadiModel::where('CreatedBy', $Id)->first();
      $Pasangan       = PasanganModel::where('CreatedBy', $Id)->count();
      $Kontak         = KontakdaruratModel::where('CreatedBy', $Id)->count();
      $Anak           = AnakModel::where('CreatedBy', $Id)->count();
      $Orangtua       = OrangtuaModel::where('CreatedBy', $Id)->count();
      $Saudara        = SaudaraModel::where('CreatedBy', $Id)->count();
      $Tambahansatu   = TambahansatuModel::where('CreatedBy', $Id)->count();
      $Tambahandua    = TambahanduaModel::where('CreatedBy', $Id)->count();
      $Jawaban        = JawabanpertanyaanModel::where('CreatedBy', $Id)->count();
      $Catatan        = CatatantambahanModel::where('CreatedBy', $Id)->count();
      $Dokumen        = DocumentModel::where('CreatedBy', $Id)->get();
      $TotalDokumen   = DocumentModel::count();
      $SuratLamaran   = DocumentModel::where('TypeDokumen', 'Lamaran')->count();
      $PasFoto        = $Dokumen->where('TypeDokumen', 'Foto')->first();
      $Pengalaman     = PengalamanModel::where('CreatedBy', $Id)->count();
      $Pelamar        = $this->userService->get_total_pelamar();
      $UserInternal   = $this->userService->get_total_pengguna();
      $PelamarTerbaru = $this->identitaspribadiService->get_pelamar_terbaru();
      $ArrayDoc       = array(
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

      return view('home', compact('Title', 'SubTitle', 'Identitas', 'Pasangan', 'Kontak', 'Anak', 'Orangtua', 
                                  'Saudara', 'Tambahansatu', 'Tambahandua', 'Jawaban', 'Catatan', 'Pengalaman', 
                                  'PasFoto', 'IdentitasDiri', 'ArrayDoc', 'SuratLamaran', 'UserInternal', 
                                  'Pelamar', 'TotalDokumen', 'PelamarTerbaru', 'User'));
    }

    public function data_grafik(Request $request) {
      if ($request->ajax()) {
        return $this->identitaspribadiService->get_pelamar_pertahun();
      }
    }

    public function check_email_verfification(Request $request) {
      if ($request->ajax()) {
        return auth()->user();
      }
    }

    public function profile() {
      $Title        = "Users";
      $SubTitle     = "Profile";

      return view('users.profile', compact('Title', 'SubTitle'));
    }

    public function password() {
      $Title        = "Users";
      $SubTitle     = "Update password";

      return view('users.password', compact('Title', 'SubTitle'));
    }

    public function update_password(Request $request) {
      $input_request  = $request->input();
      $validator      = Validator::make($input_request, [
        'NewPassword'  => 'required|string|min:7'
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

      //$NewPassword    = $request->post('NewPassword');
      $result = $this->userService->update_password($request->all());

      return $result;
    }
}
