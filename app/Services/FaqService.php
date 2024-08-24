<?php

namespace App\Services;
use App\Models\FaqModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class FaqService
{
  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $data = FaqModel::select('*')->orderBy('CreatedDate', 'DESC');

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
        if (Gate::allows('update faqs')) {
          $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete faqs')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('Pertanyaan', function ($row) {
        return $row->Pertanyaan;
      })
      ->editColumn('Jawaban', function ($row) {
        return $row->Jawaban;
      })
      ->editColumn('StatusAktivasi', function ($row) {
        return $row->StatusAktivasi == 'Aktif' ? '<span class="badge bg-success">'.strtoupper($row->StatusAktivasi).'</span>' : '<span class="badge bg-danger">'.strtoupper($row->StatusAktivasi).'</span>';
      })
      ->editColumn('CreatedBy', function ($row) {
        $user = User::find($row->CreatedBy);
        
        return $user->name;
      })
      ->rawColumns(['action', 'Pertanyaan', 'Jawaban', 'StatusAktivasi'])
      ->make(true);
  }

  public function store(array $data)
  {
    try {
      $updateData = [
        'Pertanyaan'      => $data['Pertanyaan'],
        'Jawaban'         => $data['Jawaban'], 
        'StatusAktivasi'  => $data['StatusAktivasi'],
        'TypePertanyaan'  => $data['TypePertanyaan'],
        'CreatedDate'     => date('Y-m-d H:i:s'),
        'CreatedBy'       => Auth::user()->id
      ];
      // create
      $data = FaqModel::create($updateData);

      return [
        'success' => true,
        'message' => 'Data berhasil disimpan.',
        'data'    => $data
      ];
    } catch (\Exception $e) {
      return [
        'success' => false,
        'message' => 'Gagal menyimpan data: ' . $e->getMessage()
      ];
    }
  }

  public function edit($Id) {
    try {
      $data = FaqModel::findOrFail($Id);

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
        'Pertanyaan'      => $data['Pertanyaan'],
        'Jawaban'         => $data['Jawaban'], 
        'StatusAktivasi'  => $data['StatusAktivasi'],
        'TypePertanyaan'  => $data['TypePertanyaan'],
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];

      FaqModel::where('Id', $data['kode'])->update($updateData);

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
      FaqModel::where('Id', $Id)->delete();

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

  public function show() {
    $data = FaqModel::where('StatusAktivasi', 'Aktif')->orderBy('Urutan', 'ASC')->get();

    return $data;
  }
}
