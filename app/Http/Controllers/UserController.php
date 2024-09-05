<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\UserProfile;

use App\Models\IdentitaspribadiModel;
use App\Models\PasanganModel;
use App\Models\KontakdaruratModel;
use App\Models\AnakModel;
use App\Models\OrangtuaModel;
use App\Models\SaudaraModel;
use App\Models\CatatantambahanModel;
use App\Models\TambahansatuModel;
use App\Models\TambahanduaModel;
use App\Models\PengalamanModel;
use App\Models\JawabanpertanyaanModel;
use App\Models\DocumentModel;
use App\Models\User;
use File;
use Illuminate\Support\Facades\DB;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
      $this->middleware('can:read users');
      $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $Title    = "Users";
      $SubTitle = "Daftar user";
      if ($request->ajax()) {
        return $this->userService->datatable();
      }

      return view('users.index', compact('Title', 'SubTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $Title    = "Users";
      $SubTitle = "Tambah user";

      return view('users.create', compact('Title', 'SubTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $result = $this->userService->create($request->all());

        if ($result['success']) {
            return redirect()->route('users.index')->with('success', $result['message']);
        } else {
            return back()->withInput()->with('error', $result['message']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      $Title        = "Users";
      $SubTitle     = "Edit user";
      $user         = $this->userService->getById($id);
      $UserProfile  = UserProfile::where('user_id', $user->id)->first();
      //dd($UserProfile); exit;
      //dd($user, $UserProfile);

      return view('users.edit', compact('Title', 'SubTitle', 'user', 'UserProfile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
      //dd("aaaah");
      $result = $this->userService->update($request->all(), $id);

      if ($result['success']) {
        return redirect()->route('users.index')->with('success', $result['message']);
      } else {
        return back()->withInput()->with('error', $result['message']);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
      $id            = $request->input('UserID');
      $UserID        = $request->input('UserID');
      //1. IDENTITAS PRIBADI
      $Identitas     = IdentitaspribadiModel::where('CreatedBy', $UserID)->delete();
      //2. KELUARGA & LINGKUNGAN
      $Pasangan      = PasanganModel::where('CreatedBy', $UserID)->delete();
      $Kontak        = KontakdaruratModel::where('CreatedBy', $UserID)->delete();
      $Anak          = AnakModel::where('CreatedBy', $UserID)->delete();
      $Orangtua      = OrangtuaModel::where('CreatedBy', $UserID)->delete();
      $Saudara       = SaudaraModel::where('CreatedBy', $UserID)->delete();
      //3. TAMBAHAN LAINNYA
      $Skill         = TambahansatuModel::where('CreatedBy', $UserID)->delete();
      $Pendidikan    = TambahanduaModel::where('CreatedBy', $UserID)->delete();
      $Pertanyaan    = DB::table('trans_jawaban_pertanyaan')->where('CreatedBy', $UserID)->delete();
      //4. CATATAN TAMBAHAN
      $Catatan       = CatatantambahanModel::where('CreatedBy', $UserID)->delete();
      //5. PENGALAMAN KERJA
      $Pengalaman    = PengalamanModel::where('CreatedBy', $UserID)->delete();
      //6. USER
      $User          = User::where('id', $UserID)->delete();
      //7. DOKUMEN
      $Dokumen       = DocumentModel::where('CreatedBy', $UserID)->get();
      foreach ($Dokumen as $key => $value) {
        //$Doxx[]     = $value->File;
        if (File::exists($value->File)) {
          File::delete($value->File);
          DocumentModel::where('Id', $value->Id)->delete();
        }
      }

      // $IdentitasPribadi   = IdentitaspribadiModel::where('CreatedBy', $id)->get();
      // $Pasangan           = PasanganModel::where('CreatedBy', $id)->get();
      // $Kontakdarurat      = KontakdaruratModel::where('CreatedBy', $id)->get();
      // $Anak               = AnakModel::where('CreatedBy', $id)->get();
      // $Orangtua           = OrangtuaModel::where('CreatedBy', $id)->get();
      // $Saudara            = SaudaraModel::where('CreatedBy', $id)->get();

      // $Catatantambahan    = CatatantambahanModel::where('CreatedBy', $id)->get();
      // $Tambahansatu       = TambahansatuModel::where('CreatedBy', $id)->get();
      // $Tambahandua        = TambahanduaModel::where('CreatedBy', $id)->get();

      // $Pengalaman         = PengalamanModel::where('CreatedBy', $id)->get();
      // $Jawabanpertanyaan  = JawabanpertanyaanModel::where('CreatedBy', $id)->get();
      // $Dokumen            = DocumentModel::where('CreatedBy', $id)->get();

      $result             = $this->userService->delete($id);

      return response()->json([
        'status_code'       => 200,
        'status'            => "success",
        'message'           => "Data sukses dihapus",
        'data'              => $result
        // 'Identitas'         => $Identitas, 
        // 'IdentitasPribadi'  => $IdentitasPribadi,
        // 'Pasangan'          => $Pasangan,
        // 'Kontakdarurat'     => $Kontakdarurat,
        // 'Anak'              => $Anak,
        // 'Orangtua'          => $Orangtua,
        // 'Saudara'           => $Saudara,
        // 'Catatantambahan'   => $Catatantambahan,
        // 'Tambahansatu'      => $Tambahansatu,
        // 'Tambahandua'       => $Tambahandua,
        // 'Dokumen'           => $Dokumen,
        // 'Pengalaman'        => $Pengalaman,
        // 'Jawaban'           => $Jawabanpertanyaan
      ], 200);
    }


    public function destroy(string $id)
    {
      $result = $this->userService->delete($id);

      return response()->json($result);
    }

    public function activated(Request $request) 
    {
      $result = $this->userService->activated($request->all());

      return $result;
    }
}
