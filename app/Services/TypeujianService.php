<?php

namespace App\Services;
use App\Models\TypeujianModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TypeujianService
{
  public function dataTable()
  {
    $id   = Auth::user()->id;
    $data = TypeujianModel::select('*')->where('CreatedBy', $id)->orderBy('CreatedDate', 'DESC');

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $actionBtn = '';
        if (Gate::allows('update type')) {
          $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete type')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
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
      $updateData = [
        'Nama'         => capitalizeWords($data['Nama']),
        'Urutan'       => $data['Urutan'],
        'Status'       => ucfirst($data['Status']),
        'ContohSoal'   => ucfirst($data['ContohSoal']),
        'CreatedDate'  => date('Y-m-d H:i:s'),
        'CreatedBy'    => Auth::user()->id
      ];

      $data = TypeujianModel::create($updateData);
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
      $data = TypeujianModel::findOrFail($Id);

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
        'Nama'         => capitalizeWords($data['Nama']),
        'Urutan'       => $data['Urutan'],
        'Status'       => ucfirst($data['Status']),
        'ContohSoal'   => ucfirst($data['ContohSoal']),
        'UpdatedDate'  => date('Y-m-d H:i:s'),
        'UpdatedBy'    => Auth::user()->id
      ];
      // update
      TypeujianModel::where('Id', $data['kode'])->update($updateData);

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
      TypeujianModel::where('Id', $Id)->delete();

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

  public function ShowAll($id) {
    $data = TypeujianModel::where('CreatedBy', $id)->orderBy('Urutan', 'ASC')->get();

    return $data;
  }
}
