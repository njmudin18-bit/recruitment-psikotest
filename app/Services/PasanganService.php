<?php

namespace App\Services;
use App\Models\PasanganModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;

class PasanganService
{

  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $id   = Auth::user()->id;
    $data = PasanganModel::select('*')->where('CreatedBy', $id)->orderBy('CreatedDate', 'DESC');

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
        if (Gate::allows('update keluarga')) {
          $actionBtn .= '<button type="button" name="edit" onclick="editPasangan('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete keluarga')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapusPasangan('.$row->Id.')" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('TTL', function ($row) {
        return $row->TempatLahir.", ".$row->TanggalLahir;
      })
      ->editColumn('Jk', function ($row) {
        return $row->Jk;
        //return $row->Jk == 'L' ? 'Laki-laki' : 'Perempuan';
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

  public function store(array $data)
  {
    try {
      $Cek    = PasanganModel::where('Email', $data['EmailPasangan'])->count();
      if ($Cek == 0) {
        $updateData = [
          'NamaPasangan'    => capitalizeWords($data['NamaPasangan']),
          'Jk'              => $data['JkPasangan'],
          'TempatLahir'     => ucfirst($data['TempatLahirPasangan']),
          'TanggalLahir'    => $data['TanggalLahirPasangan'],
          'Pendidikan'      => $data['PendidikanPasangan'],
          'Pekerjaan'       => capitalizeWords($data['PekerjaanPasangan']),
          'Perusahaan'      => capitalizeWords($data['PerusahaanPasangan']),
          'Jabatan'         => capitalizeWords($data['JabatanPasangan']),
          'Email'           => strtolower($data['EmailPasangan']),
          'NoHp'            => $data['NoHpPasangan'],
          'AlamatKtp'       => capitalizeWords($data['AlamatPasangan']),
          'Sosmed'          => $data['SosmedPasangan'],
          'CreatedDate'     => date('Y-m-d H:i:s'),
          'CreatedBy'       => Auth::user()->id
        ];
        // create
        $data = PasanganModel::create($updateData);
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
      $data = PasanganModel::findOrFail($Id);

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
        'NamaPasangan'    => capitalizeWords($data['NamaPasangan']),
        'Jk'              => $data['JkPasangan'],
        'TempatLahir'     => ucfirst($data['TempatLahirPasangan']),
        'TanggalLahir'    => $data['TanggalLahirPasangan'],
        'Pendidikan'      => $data['PendidikanPasangan'],
        'Pekerjaan'       => capitalizeWords($data['PekerjaanPasangan']),
        'Perusahaan'      => capitalizeWords($data['PerusahaanPasangan']),
        'Jabatan'         => capitalizeWords($data['JabatanPasangan']),
        'Email'           => strtolower($data['EmailPasangan']),
        'NoHp'            => $data['NoHpPasangan'],
        'AlamatKtp'       => capitalizeWords($data['AlamatPasangan']),
        'Sosmed'          => $data['SosmedPasangan'],
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];
      // update
      PasanganModel::where('Id', $data['kodePasangan'])->update($updateData);
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
      PasanganModel::where('Id', $Id)->delete();

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
    $data = PasanganModel::where('CreatedBy', $id)->first();

    return $data;
  }
}
