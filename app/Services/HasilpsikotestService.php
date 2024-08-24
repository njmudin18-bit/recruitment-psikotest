<?php

namespace App\Services;
use App\Models\HasilujianModel;
use App\Models\SoalModel;
use App\Models\User;
use App\Models\IdentitaspribadiModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HasilpsikotestService
{
  public function __construct()
  {
      //
  }

  public function dataTable($StarDate, $EndDate)
  {
    //$data = HasilujianModel::select('*')->orderBy('trans_hasilujian.CreatedDate', 'DESC');
    $data = HasilujianModel::select('trans_hasilujian.*', 'ms_ujian.Nama as NamaUjian', 'users.name as NamaPeserta')
            ->leftJoin('ms_ujian', 'ms_ujian.Id', '=', 'trans_hasilujian.IdUjian')
            ->leftJoin('users', 'users.id', '=', 'trans_hasilujian.CreatedBy')
            ->whereRaw('DATE(trans_hasilujian.CreatedDate) BETWEEN ? AND ?', [$StarDate, $EndDate])
            ->orderBy('trans_hasilujian.CreatedDate', 'DESC');

    return DataTables::of($data)
    ->addIndexColumn()
    ->addColumn('action', function ($row) {
      $actionBtn  = '';
      $Isi        = "'".$row->Id."', '".$row->NamaPeserta."', '".$row->NamaUjian."'";
      if (Gate::allows('delete hasil')) {
        $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$Isi.')" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
      }
      
      return '<div class="text-center">' . $actionBtn . '</div>';
    })
    ->editColumn('Posisi', function ($row) {
      $Check = IdentitaspribadiModel::where('CreatedBy', $row->CreatedBy)->count();
      if ($Check > 0) {
        $Data = IdentitaspribadiModel::where('CreatedBy', $row->CreatedBy)->first();

        return $Data->Posisi;
      } else {
        return '-';
      }
    })
    ->editColumn('Soal', function ($row) {
      $Check = SoalModel::where('IdUjian', $row->IdUjian)->count();
      if ($Check > 0) {
        return $Check;
      } else {
        return 0;
      }
    })
    ->rawColumns(['action','Posisi','Soal'])
    ->make(true);
  }

  public function edit($Id) {
    try {
      $data = HasilujianModel::findOrFail($Id);

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

  public function destroy($Id)
  {
    try {
      HasilujianModel::where('Id', $Id)->delete();

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
    $data = HasilujianModel::where('CreatedBy', $id)->first();

    return $data;
  }
}
