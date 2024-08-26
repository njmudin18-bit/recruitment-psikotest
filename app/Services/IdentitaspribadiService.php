<?php

namespace App\Services;
use App\Models\IdentitaspribadiModel;
use App\Models\User;

use App\Models\PasanganModel;
use App\Models\KontakdaruratModel;
use App\Models\AnakModel;
use App\Models\OrangtuaModel;
use App\Models\SaudaraModel;
use App\Models\TambahansatuModel;
use App\Models\TambahanduaModel;
use App\Models\CatatantambahanModel;
use App\Models\PengalamanModel;
use App\Models\DocumentModel;

use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use File;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class IdentitaspribadiService
{
  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $id   = Auth::user()->id;
    $data = IdentitaspribadiModel::select('*')->where('CreatedBy', $id)->orderBy('CreatedDate', 'DESC');

    return DataTables::of($data)
    ->addIndexColumn()
    ->editColumn('CreatedDate', function ($row) {
      return Carbon::parse($row->CreatedDate)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    })
    ->editColumn('CreatedDate', function ($row) {
      return Carbon::parse($row->CreatedDate)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    })
    ->addColumn('action', function ($row) {
      $actionBtn = '';
      $id        = Auth::user()->id;
      if (Gate::allows('update identitas')) {
        $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
      }
      if (Gate::allows('delete identitas')) {
        $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="deleteRole btn btn-danger btn-sm me-2" title="Hapus"><i class="bx bx-x-circle"></i></button>';
      }

      $actionBtn .= '<button type="button" name="view" onclick="view('.$id.')" class="btn btn-info btn-sm" title="Cek full data diri"><i class="bx bx-search-alt"></i></button>';
      
      return '<div class="text-center">' . $actionBtn . '</div>';
    })
    ->editColumn('TTL', function ($row) {
      return $row->TempatLahir.", ".$row->TanggalLahir;
    })
    ->editColumn('Jk', function ($row) {
      return $row->Jk == 'L' ? 'Laki-laki' : 'Perempuan';
    })
    ->editColumn('CreatedBy', function ($row) {
      $user = User::find($row->CreatedBy);
      
      return $user->name;
    })
    ->editColumn('Usia', function ($row) {
      return Carbon::parse($row->TanggalLahir)->age;
    })
    ->rawColumns(['action', 'TTL', 'Usia'])
    ->make(true);
  }

  public function report($StartDate, $EndDate)
  {
    $data = User::whereHas('roles', function ($query) {
              $query->where('name', '=', 'Pelamar');
            })->with('roles')
            ->select(
              'users.*', 'users.created_at AS TanggalDaftar', 'trans_identitaspribadi.*'
            )
            ->leftJoin('trans_identitaspribadi', 'trans_identitaspribadi.CreatedBy', '=', 'users.id')
            ->whereRaw('DATE(users.created_at) BETWEEN ? AND ?', [$StartDate, $EndDate])
            ->orderBy('users.id', 'DESC')
            ->get();

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $actionBtn  = '';
        $Isi        = "'".$row->CreatedBy."', '".$row->Nama."'";
        $actionBtn .= '<button type="button" name="view" onclick="hapus('.$Isi.')" class="btn btn-danger btn-sm" title="Hapus data & semua dokumen"><i class="bx bx-trash-alt"></i></button>';
        $actionBtn .= '<button type="button" class="btn btn-success btn-sm ms-1 me-1" data-bs-toggle="modal" data-bs-target="#ModalTable"
                          data-record-id="'.$row->CreatedBy.'" data-record-name="'.$row->Nama.'" title="Cek dokumen">
                          <i class="bx bx-file-find"></i>
                        </button>';
        if ($row->CreatedBy == null) {
          $actionBtn .= '<button type="button" name="view" class="btn btn-info btn-sm" title="Belum dilengkapi" disabled><i class="bx bx-search-alt"></i></button>';
        } else {
          $actionBtn .= '<button type="button" name="view" onclick="view('.$row->CreatedBy.')" class="btn btn-info btn-sm" title="Cek full data diri"><i class="bx bx-search-alt"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('Nama', function ($row) {
        return $row->Nama == null ? $row->name : $row->Nama; ;
      })
      ->editColumn('Posisi', function ($row) {
        return capitalizeWords($row->Posisi == null ? '-' : $row->Posisi);
      })
      ->editColumn('Department', function ($row) {
        return capitalizeWords($row->Department == null ? '-' : $row->Department);
      })
      ->editColumn('NoHp', function ($row) {
        return $row->NoHp == null ? '-' : $row->NoHp;
      })
      ->editColumn('Email', function ($row) {
        return $row->Email == null ? '-' : $row->Email;
      })
      ->editColumn('Jk', function ($row) {
        return $row->Jk == null ? '-' : $row->Jk;
      })
      ->editColumn('TanggalLahir', function ($row) {
        return Carbon::parse($row->TanggalLahir)->age;
      })
      ->editColumn('TanggalDaftar', function ($row) {
        return $row->TanggalDaftar;
      })
      ->rawColumns(['action'])
      ->make(true);
  }

  public function get_pelamar_terbaru() {
    $data = IdentitaspribadiModel::take('6')
            ->orderBy('CreatedDate', 'DESC')
            ->get();
    
    return $data;
  }

  public function get_pelamar_pertahun() {
    $Data = DB::table('trans_identitaspribadi')
    ->select(
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 1 THEN 1 ELSE 0 END) AS 'Jan'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 2 THEN 1 ELSE 0 END) AS 'Feb'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 3 THEN 1 ELSE 0 END) AS 'Mar'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 4 THEN 1 ELSE 0 END) AS 'Apr'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 5 THEN 1 ELSE 0 END) AS 'May'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 6 THEN 1 ELSE 0 END) AS 'Jun'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 7 THEN 1 ELSE 0 END) AS 'Jul'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 8 THEN 1 ELSE 0 END) AS 'Aug'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 9 THEN 1 ELSE 0 END) AS 'Sep'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 10 THEN 1 ELSE 0 END) AS 'Oct'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 11 THEN 1 ELSE 0 END) AS 'Nov'"),
      DB::raw("SUM(CASE MONTH(CreatedDate) WHEN 12 THEN 1 ELSE 0 END) AS 'Dec'"),
    )
    ->whereRaw('YEAR(CreatedDate) = ?', [Carbon::now()->year])
    ->get();

    return json_encode($Data);
  }

  public function store(array $data)
  {
    try {
      $Cek    = IdentitaspribadiModel::where('Email', $data['Email'])->count();
      if ($Cek == 0) {
        $updateData = [
          'Nama'                => capitalizeWords($data['Nama']),
          'TempatLahir'         => ucfirst($data['TempatLahir']),
          'TanggalLahir'        => $data['TanggalLahir'],
          'Jk'                  => $data['Jk'],
          'StatusNikah'         => $data['StatusNikah'],
          'NoKtp'               => $data['NoKtp'],
          'AlamatKtp'           => capitalizeWords($data['AlamatKtp']),
          'AlamatRumahTinggal'  => capitalizeWords($data['AlamatRumahTinggal']),
          'StatusKepemilikan'   => $data['StatusKepemilikan'],
          'NoHp'                => $data['NoHp'],
          'Email'               => strtolower($data['Email']),
          'Sosmed'              => $data['Sosmed'],
          'Kewarganegaraan'     => $data['Kewarganegaraan'],
          'Agama'               => $data['Agama'],
          'BeratBadan'          => $data['BeratBadan'],
          'TinggiBadan'         => $data['TinggiBadan'],
          'GolDarah'            => $data['GolDarah'],
          'Vaksin'              => $data['Vaksin'],
          'Alergi'              => $data['Alergi'],
          'Pengobatan'          => $data['Pengobatan'],
          'Department'          => $data['Department'],
          'Department'          => $data['Department'],
          'Posisi'              => $data['Posisi'],
          'SumberInfo'          => $data['SumberInfo'],
          'GajiDiminta'         => str_replace(",", "", $data['GajiDiminta']),
          'CreatedDate'         => date('Y-m-d H:i:s'),
          'CreatedBy'           => Auth::user()->id
        ];
        // create
        $data = IdentitaspribadiModel::create($updateData);
        return response()->json([
          'status_code' => 200,
          'status'      => "success",
          'message'     => "Data berhasil disimpan"
        ], 200);
      } else {
        return response()->json([
          'status_code' => 409,
          'status'      => "success",
          'message'     => "Data email sudah tersedia",
          'data'        => array()
        ], 409);
      }
    } catch (\Exception $e) {
      return response()->json([
        'status_code' => 500,
        'status'      => "success",
        'message'     => "Data gagal disimpan ".$e->getMessage(),
        'data'        => array()
      ], 500);
    }
  }

  public function edit($Id) {
    try {

      $data = IdentitaspribadiModel::findOrFail($Id);

      return response()->json([
        'status_code' => 200,
        'status'      => "success",
        'message'     => "Data berhasil ditampilkan",
        'data'        => $data
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status_code' => 500,
        'status'      => "success",
        'message'     => "Data gagal ditampilkan ".$e->getMessage(),
        'data'        => array()
      ], 500);
    }
  }

  public function update(array $data)
  {
    try {
      $updateData = [
        'Nama'                => capitalizeWords($data['Nama']),
        'TempatLahir'         => ucfirst($data['TempatLahir']),
        'TanggalLahir'        => $data['TanggalLahir'],
        'Jk'                  => $data['Jk'],
        'StatusNikah'         => $data['StatusNikah'],
        'NoKtp'               => $data['NoKtp'],
        'AlamatKtp'           => capitalizeWords($data['AlamatKtp']),
        'AlamatRumahTinggal'  => capitalizeWords($data['AlamatRumahTinggal']),
        'StatusKepemilikan'   => $data['StatusKepemilikan'],
        'NoHp'                => $data['NoHp'],
        'Email'               => strtolower($data['Email']),
        'Sosmed'              => $data['Sosmed'],
        'Kewarganegaraan'     => $data['Kewarganegaraan'],
        'Agama'               => $data['Agama'],
        'BeratBadan'          => $data['BeratBadan'],
        'TinggiBadan'         => $data['TinggiBadan'],
        'GolDarah'            => $data['GolDarah'],
        'Vaksin'              => $data['Vaksin'],
        'Alergi'              => $data['Alergi'],
        'Pengobatan'          => $data['Pengobatan'],
        'Department'          => $data['Department'],
        'Posisi'              => $data['Posisi'],
        'SumberInfo'          => $data['SumberInfo'],
        'GajiDiminta'         => str_replace(",", "", $data['GajiDiminta']),
        'UpdatedDate'         => date('Y-m-d H:i:s'),
        'UpdatedBy'           => Auth::user()->id
      ];
      // update
      IdentitaspribadiModel::where('Id', $data['kode'])->update($updateData);
      return response()->json([
        'status_code' => 200,
        'status'      => "success",
        'message'     => "Data berhasil diupdate",
        'data'        => $data
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status_code' => 500,
        'status'      => "success",
        'message'     => "Data gagal diupdate ".$e->getMessage(),
        'data'        => array()
      ], 500);
    }
  }

  public function destroy($Id)
  {
    try {
      IdentitaspribadiModel::where('Id', $Id)->delete();

      return [
        'success' => true,
        'message' => 'Data berhasil dihapus.'
      ];
    } catch (\Exception $e) {
      return [
        'success' => false,
        'message' => 'Gagal menghapus data: ' . $e->getMessage()
      ];
    }
  }

  public function showByUser($id) {
    $data = IdentitaspribadiModel::where('CreatedBy', $id)->first();

    return $data;
  }

  public function document_list($UserID) {
    $data = DocumentModel::select('*')->where('CreatedBy', $UserID)->orderBy('CreatedDate', 'DESC');

    return DataTables::of($data)
    ->addIndexColumn()
    ->editColumn('CreatedDate', function ($row) {
      return Carbon::parse($row->CreatedDate)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    })
    ->editColumn('CreatedDate', function ($row) {
      return Carbon::parse($row->CreatedDate)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s');
    })
    ->addColumn('action', function ($row) {
      $DocLink    = url('/')."/".$row->File;
      $actionBtn  = '';
      if (Gate::allows('update dokumen')) {
        $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
      }
      if (Gate::allows('delete dokumen')) {
        $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="deleteRole btn btn-danger btn-sm me-2" title="Hapus"><i class="bx bx-x-circle"></i></button>';
      }

      $actionBtn .= '<a href="'.$DocLink.'" class="btn btn-info btn-sm" target="_blank"><i class="bx bx-copy-alt"></i></a>';
      
      return '<div class="text-center">' . $actionBtn . '</div>';
    })
    ->editColumn('TypeFile', function ($row) {
      $FileURL = url('/')."/".$row->File;
      return $row->TypeFile == 'png' ? '<a href="'.$FileURL.'" target="_blank"><i class="bx bxs-file-png fs-2 text-success"></i></a>' : '<a href="'.$FileURL.'" target="_blank"><i class="bx bxs-file-pdf fs-2 text-danger"></i></a>';
    })
    ->editColumn('UkuranFile', function ($row) {
      return $row->UkuranFile." KB";
    })
    ->editColumn('CreatedBy', function ($row) {
      $user = User::find($row->CreatedBy);
      
      return $user->name;
    })
    ->rawColumns(['action', 'UkuranFile', 'TypeFile'])
    ->make(true);
  }

  public function hapus_semua_data_user($UserID) {
    //MENU
    //1. IDENTITAS PRIBADI
    //DocumentModel::where('Id', $Id)->delete();
    $Identitas     = IdentitaspribadiModel::select('*')->where('CreatedBy', $UserID)->delete();
    //2. KELUARGA & LINGKUNGAN
    $Pasangan      = PasanganModel::select('*')->where('CreatedBy', $UserID)->delete();
    $Kontak        = KontakdaruratModel::select('*')->where('CreatedBy', $UserID)->delete();
    $Anak          = AnakModel::select('*')->where('CreatedBy', $UserID)->delete();
    $Orangtua      = OrangtuaModel::select('*')->where('CreatedBy', $UserID)->delete();
    $Saudara       = SaudaraModel::select('*')->where('CreatedBy', $UserID)->delete();
    //3. TAMBAHAN LAINNYA
    $Skill         = TambahansatuModel::select('*')->where('CreatedBy', $UserID)->delete();
    $Pendidikan    = TambahanduaModel::select('*')->where('CreatedBy', $UserID)->delete();
    $Pertanyaan    = DB::table('trans_jawaban_pertanyaan')->where('CreatedBy', $UserID)->delete();
    //4. CATATAN TAMBAHAN
    $Catatan       = CatatantambahanModel::select('*')->where('CreatedBy', $UserID)->delete();
    //5. UPLOAD DOKUMEN
    $Dokumen       = DocumentModel::select('*')->where('CreatedBy', $UserID)->get();
    foreach ($Dokumen as $key => $value) {
      //$Doxx[]     = $value->File;
      if (File::exists($value->File)) {
        File::delete($value->File);
        DocumentModel::where('Id', $value->Id)->delete();
      }
    }
    //6. PENGALAMAN KERJA
    $Pengalaman    = PengalamanModel::select('*')->where('CreatedBy', $UserID)->delete();

    return response()->json([
      'status_code'   => 200,
      'status'        => "success",
      'message'       => "Data sukses dihapus"
    ], 200);
  }
}
