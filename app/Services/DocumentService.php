<?php

namespace App\Services;
use App\Models\DocumentModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DocumentService
{
  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $id   = Auth::user()->id;
    $data = DocumentModel::select('*')->where('CreatedBy', $id)->orderBy('CreatedDate', 'DESC');

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
        return $row->TypeFile == 'png' ? '<i class="bx bxs-file-png fs-2 text-success"></i>' : '<i class="bx bxs-file-pdf fs-2 text-danger"></i>';
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

  public function store(array $data, $StoredPath, $FileExt, $FileSize)
  {
    try {
      $updateData = [
        'NamaDokumen'     => capitalizeWords($data['NamaDokumen']),
        'TypeDokumen'     => $data['TypeDokumen'],
        'TypeFile'        => $FileExt,
        'UkuranFile'      => round($FileSize, 2),
        'File'            => $StoredPath,
        'CreatedDate'     => date('Y-m-d H:i:s'),
        'CreatedBy'       => Auth::user()->id
      ];

      $data = DocumentModel::create($updateData);
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

      $data = DocumentModel::findOrFail($Id);

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

  public function update(array $data, $StoredPath, $FileExt, $FileSize)
  {
    try {
      $updateData = [
        'NamaDokumen'     => capitalizeWords($data['NamaDokumen']),
        'TypeDokumen'     => $data['TypeDokumen'],
        'TypeFile'        => $FileExt,
        'UkuranFile'      => round($FileSize, 2),
        'File'            => $StoredPath,
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];
      // update
      DocumentModel::where('Id', $data['kode'])->update($updateData);

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

  public function updateWF(array $data)
  {
    try {
      $updateData = [
        'NamaDokumen'     => capitalizeWords($data['NamaDokumen']),
        'TypeDokumen'     => $data['TypeDokumen'],
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];
      // update
      DocumentModel::where('Id', $data['kode'])->update($updateData);

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
      $Dokumen    = DocumentModel::findOrFail($Id);
      $OldDokumen = $Dokumen->File;
      File::delete($OldDokumen);
      $Dokumen->delete();

      DocumentModel::where('Id', $Id)->delete();

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

  public function showByUser() {
    $data = DocumentModel::where('CreatedBy', Auth::user()->id)->get();

    return $data;
  }
}
