<?php

namespace App\Services;
use App\Models\AnakModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class AnakService
{
  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $id   = Auth::user()->id;
    $data = AnakModel::select('*')->where('CreatedBy', $id)->orderBy('CreatedDate', 'DESC');

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
          $actionBtn .= '<button type="button" name="edit" onclick="editAnak('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete keluarga')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapusAnak('.$row->Id.')" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
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
      ->rawColumns(['action', 'TTL'])
      ->make(true);
  }

  public function store(array $data)
  {
    try {
      $updateData = [
        'Nama'                => capitalizeWords($data['NamaAnak']),
        'Jk'                  => $data['JkAnak'],
        'TempatLahir'         => ucfirst($data['TempatLahirAnak']),
        'TanggalLahir'        => $data['TanggalLahirAnak'],
        'Pendidikan'          => strtoupper($data['PendidikanAnak']),
        'Pekerjaan'           => ucfirst($data['PekerjaanAnak']),
        'CreatedDate'         => date('Y-m-d H:i:s'),
        'CreatedBy'           => Auth::user()->id
      ];

      $data = AnakModel::create($updateData);
      return response()->json([
        'status_code' => 200,
        'status'      => "success",
        'message'     => "Data berhasil disimpan"
      ], 200);
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

      $data = AnakModel::findOrFail($Id);

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
        'Nama'                => capitalizeWords($data['NamaAnak']),
        'Jk'                  => $data['JkAnak'],
        'TempatLahir'         => ucfirst($data['TempatLahirAnak']),
        'TanggalLahir'        => $data['TanggalLahirAnak'],
        'Pendidikan'          => strtoupper($data['PendidikanAnak']),
        'Pekerjaan'           => ucfirst($data['PekerjaanAnak']),
        'UpdatedDate'         => date('Y-m-d H:i:s'),
        'UpdatedBy'           => Auth::user()->id
      ];
      // update
      AnakModel::where('Id', $data['kodeAnak'])->update($updateData);

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
      AnakModel::where('Id', $Id)->delete();

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
    $data = AnakModel::where('CreatedBy', $id)->get();

    return $data;
  }
}
