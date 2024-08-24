<?php

namespace App\Services;
use App\Models\PengalamanModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PengalamanService
{
  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $id   = Auth::user()->id;
    $data = PengalamanModel::select('*')->where('CreatedBy', $id)->orderBy('CreatedDate', 'DESC');

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
        if (Gate::allows('update pengalaman')) {
          $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete pengalaman')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('JodDesc', function ($row) {
        return $row->JodDesc;
      })
      ->editColumn('CreatedBy', function ($row) {
        $user = User::find($row->CreatedBy);
        
        return $user->name;
      })
      ->rawColumns(['action', 'JodDesc'])
      ->make(true);
  }

  public function store(array $data)
  {
    try {
      $updateData = [
        'Perusahaan'     => capitalizeWords($data['Perusahaan']),
        'Posisi'         => capitalizeWords($data['Posisi']),
        'StartDate'      => $data['StartDate'],
        'EndDate'        => $data['EndDate'],
        'JobDesc'        => ucfirst($data['JobDesc']),
        'CreatedDate'    => date('Y-m-d H:i:s'),
        'CreatedBy'      => Auth::user()->id
      ];

      $data = PengalamanModel::create($updateData);
      return response()->json([
        'status_code' => 200,
        'status'      => "success",
        'message'     => "Data berhasil disimpan"
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status_code' => 500,
        'status'      => "error",
        'message'     => "Data gagal disimpan ".$e->getMessage(),
        'data'        => array()
      ], 500);
    }
  }

  public function edit($Id) {
    try {

      $data = PengalamanModel::findOrFail($Id);

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
        'Perusahaan'     => capitalizeWords($data['Perusahaan']),
        'Posisi'         => capitalizeWords($data['Posisi']),
        'StartDate'      => $data['StartDate'],
        'EndDate'        => $data['EndDate'],
        'JobDesc'        => ucfirst($data['JobDesc']),
        'UpdatedDate'    => date('Y-m-d H:i:s'),
        'UpdatedBy'      => Auth::user()->id
      ];
      // update
      PengalamanModel::where('Id', $data['kode'])->update($updateData);

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
      PengalamanModel::where('Id', $Id)->delete();

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
    $data = PengalamanModel::where('CreatedBy', $id)->get();

    return $data;
  }
}
