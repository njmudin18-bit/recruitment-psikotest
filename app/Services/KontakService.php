<?php

namespace App\Services;
use App\Models\KontakdaruratModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class KontakService
{
  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $id   = Auth::user()->id;
    $data = KontakdaruratModel::select('*')->where('CreatedBy', $id)->orderBy('CreatedDate', 'DESC');

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $actionBtn = '';
        if (Gate::allows('update keluarga')) {
          $actionBtn .= '<button type="button" name="edit" onclick="editKontak('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete keluarga')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapusKontak('.$row->Id.')" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('CreatedBy', function ($row) {
        $user = User::find($row->CreatedBy);
        
        return $user->name;
      })
      ->rawColumns(['action'])
      ->make(true);
  }

  public function store(array $data)
  {
    try {
      $Cek    = KontakdaruratModel::where('NoHp', $data['NoHpKontak'])->count();
      if ($Cek == 0) {
        $updateData = [
          'Nama'                => capitalizeWords($data['NamaKontak']),
          'Hubungan'            => ucfirst($data['HubunganKontak']),
          'Alamat'              => ucfirst($data['AlamatKontak']),
          'NoHp'                => $data['NoHpKontak'],
          'CreatedDate'         => date('Y-m-d H:i:s'),
          'CreatedBy'           => Auth::user()->id
        ];
        // create
        $data = KontakdaruratModel::create($updateData);
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
      $data = KontakdaruratModel::findOrFail($Id);

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
        'Nama'                => capitalizeWords($data['NamaKontak']),
        'Hubungan'            => ucfirst($data['HubunganKontak']),
        'Alamat'              => ucfirst($data['AlamatKontak']),
        'NoHp'                => $data['NoHpKontak'],
        'UpdatedDate'         => date('Y-m-d H:i:s'),
        'UpdatedBy'           => Auth::user()->id
      ];
      // update
      KontakdaruratModel::where('Id', $data['kodeKontak'])->update($updateData);
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
      KontakdaruratModel::where('Id', $Id)->delete();

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
    $data = KontakdaruratModel::where('CreatedBy', $id)->first();

    return $data;
  }
}
