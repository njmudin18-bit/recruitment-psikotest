<?php

namespace App\Services;
use App\Models\NamaujianModel;
use App\Models\User;
use App\Models\SoalModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NamaujianService
{
  public function DaftarUjian()
  {
    $now  = Carbon::now()->format('Y-m-d');
    $data = NamaujianModel::select('*')
            ->where('Status', 'AKTIF')
            ->whereRaw('DATE(StartDate) >= ?', [$now])
            ->orderBy('CreatedDate', 'DESC');

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $Url        = "'".url('/ujian-detail').'/'.$row->Id."'";
        //$Isi        = "'".$row->Id."', '".$row->Nama."', '".$row->Durasi."', '".$row->StartDate."', '".$row->EndDate."'";
        $Isi        = "'".Auth::user()->id."', '".url('/ujian-detail').'/'.$row->Id."'";
        $actionBtn  = '<button type="button" name="tambah" onclick="open_detail('.$Isi.')" class="btn btn-info btn-sm me-2" title="Masuk ke Ujian"><i class="bx bx-log-in-circle"></i></button>';
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('CreatedBy', function ($row) {
        $user = User::find($row->CreatedBy);
        
        return $user->name;
      })
      ->editColumn('JumlahSoal', function ($row) {
        $JumlahSoal = SoalModel::where('IdUjian', $row->Id)->where('Status', 'AKTIF')->count();
        
        return $JumlahSoal;
      })
      ->rawColumns(['action','JumlahSoal'])
      ->make(true);
  }

  public function dataTable()
  {
    $data = NamaujianModel::select('*')->where('Status', 'AKTIF')->orderBy('CreatedDate', 'DESC');

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $actionBtn = '';
        if (Gate::allows('update ikuti')) {
          $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete ikuti')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="btn btn-danger btn-sm me-2" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }

        $Url        = "'".url('/soal').'/'.$row->Id."'";
        if ($row->Status == 'AKTIF') {
          $actionBtn .= '<button type="button" name="tambah" onclick="refresh_token('.$row->Id.')" class="btn btn-info btn-sm me-2" title="Refresh PIN"><i class="bx bx-repost"></i></button>';
          $actionBtn .= '<button type="button" name="tambah" onclick="tambah_soal('.$Url.')" class="btn btn-success btn-sm" title="Tambah Soal"><i class="bx bxs-add-to-queue"></i></button>';
        } else {
          $actionBtn .= '<button type="button" name="tambah" disabled class="btn btn-info btn-sm me-2" title="Refresh PIN"><i class="bx bx-repost"></i></button>';
          $actionBtn .= '<button type="button" name="tambah" disabled class="btn btn-success btn-sm" title="Tambah Soal"><i class="bx bxs-add-to-queue"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('CreatedBy', function ($row) {
        $user = User::find($row->CreatedBy);
        
        return $user->name;
      })
      ->editColumn('JumlahSoal', function ($row) {
        $JumlahSoal = SoalModel::where('IdUjian', $row->Id)->where('Status', 'AKTIF')->count();
        
        return $JumlahSoal;
      })
      ->rawColumns(['action','JumlahSoal'])
      ->make(true);
  }

  public function store(array $data)
  {
    try {
      $updateData = [
        'Nama'         => capitalizeWords($data['Nama']),
        'Acak'         => $data['Acak'],
        'StartDate'    => $data['StartDate'],
        'EndDate'      => $data['EndDate'],
        'Durasi'       => $data['Durasi'],
        'Score'        => $data['Score'],
        'Pin'          => strtoupper(Str::random(6)),
        'Status'       => $data['Status'],
        'CreatedDate'  => date('Y-m-d H:i:s'),
        'CreatedBy'    => Auth::user()->id
      ];

      $data = NamaujianModel::create($updateData);
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
      $data = NamaujianModel::findOrFail($Id);

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
        'Acak'         => $data['Acak'],
        'Durasi'       => $data['Durasi'],
        'Score'        => $data['Score'],
        'StartDate'    => $data['StartDate'],
        'EndDate'      => $data['EndDate'],
        'Status'       => $data['Status'],
        'UpdatedDate'  => date('Y-m-d H:i:s'),
        'UpdatedBy'    => Auth::user()->id
      ];
      // update
      NamaujianModel::where('Id', $data['kode'])->update($updateData);

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
      NamaujianModel::where('Id', $Id)->delete();

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

  public function refresh_pin($Id)
  {
    try {
      $updateData = [
        'Pin'          => strtoupper(Str::random(6)),
        'UpdatedDate'  => date('Y-m-d H:i:s'),
        'UpdatedBy'    => Auth::user()->id
      ];
      // update
      NamaujianModel::where('Id', $Id)->update($updateData);

      return response()->json([
        'status_code' => 200,
        'status'      => "success",
        'message'     => "PIN berhasil diupdate",
        'data'        => $updateData
      ], 200);
    } catch (\Exception $e) {
      return response()->json([
        'status_code' => 500,
        'status'      => "success",
        'message'     => "PIN gagal diupdate ".$e->getMessage(),
        'data'        => array()
      ], 500);
    }
  }

  public function ShowAll($id) {
    $data = NamaujianModel::where('CreatedBy', $id)->get();

    return $data;
  }
}
