<?php

namespace App\Services;
use App\Models\SoalModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SoalService
{
  public function dataTable($Id)
  {
    $data = SoalModel::select('trans_soal.*', 'ms_typeujian.Nama', 'ms_typeujian.Id AS IDUjian')
            ->leftJoin('ms_typeujian', 'ms_typeujian.Id', '=', 'trans_soal.IdTypeUjian')
            ->where('trans_soal.IdUjian', $Id)
            ->orderBy('trans_soal.CreatedDate', 'DESC')
            ->get();

    return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $actionBtn = '';
        if (Gate::allows('update ujian')) {
          if ($row->IdTypeUjian == '7' || $row->IdTypeUjian == 7) {
            $actionBtn .= '<button type="button" name="edit" onclick="edit_test_warna('.$row->Id.')" class="btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
          } else {
            $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
          }
        }
        if (Gate::allows('delete ujian')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="btn btn-danger btn-sm me-2" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('Soal', function ($row) {
        return $row->Soal;
      })
      ->editColumn('Gambar', function ($row) {
        if ($row->Gambar == null || $row->Gambar == '') {
          return '-';
        } else {
          return '<img src="'.url($row->Gambar).'" alt="" class="rounded avatar-sm border border-2">';
        }
      })
      ->editColumn('PosisiGambar', function ($row) {
        if ($row->PosisiGambar == 'None') {
          return '-';
        } else {
          return $row->PosisiGambar;
        }
      })
      ->editColumn('E', function ($row) {
        if ($row->E == '' || $row->E == null) {
          return '-';
        } else {
          return $row->E;
        }
      })
      ->rawColumns(['action','Soal','Gambar','PosisiGambar','E'])
      ->make(true);
  }

  public function store(array $data, $StoredPath)
  {
    try {
      $updateData = [
        'Soal'            => ucfirst($data['Soal']),
        'IdUjian'         => $data['IdUjian'],
        'A'               => ucwords($data['JawabanA']),
        'B'               => ucwords($data['JawabanB']),
        'C'               => ucwords($data['JawabanC']),
        'D'               => ucwords($data['JawabanD']),
        'E'               => ucwords($data['JawabanE']),
        'Kunci'           => $data['Kunci'],
        'PosisiGambar'    => $data['PosisiGambar'],
        'Gambar'          => $StoredPath,
        'Status'          => $data['Status'],
        'IdTypeUjian'     => $data['TypeUjian'],
        'CreatedDate'     => date('Y-m-d H:i:s'),
        'CreatedBy'       => Auth::user()->id
      ];

      $data = SoalModel::create($updateData);
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

  public function store_wp(array $data)
  {
    try {
      $updateData = [
        'Soal'            => ucfirst($data['Soal']),
        'IdUjian'         => $data['IdUjian'],
        'A'               => ucwords($data['JawabanA']),
        'B'               => ucwords($data['JawabanB']),
        'C'               => ucwords($data['JawabanC']),
        'D'               => ucwords($data['JawabanD']),
        'E'               => ucwords($data['JawabanE']),
        'Kunci'           => $data['Kunci'],
        'PosisiGambar'    => $data['PosisiGambar'],
        'Status'          => $data['Status'],
        'IdTypeUjian'     => $data['TypeUjian'],
        'CreatedDate'     => date('Y-m-d H:i:s'),
        'CreatedBy'       => Auth::user()->id
      ];

      $data = SoalModel::create($updateData);
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

  public function store_warna(array $data, $StoredPath)
  {
    try {
      $updateData = [
        'IdUjian'         => $data['IdUjianWarna'],
        'Kunci'           => $data['KunciWarna'],
        'PosisiGambar'    => $data['PosisiGambarWarna'],
        'Gambar'          => $StoredPath,
        'Status'          => $data['StatusWarna'],
        'IdTypeUjian'     => $data['TypeUjianWarna'],
        'CreatedDate'     => date('Y-m-d H:i:s'),
        'CreatedBy'       => Auth::user()->id
      ];

      $data = SoalModel::create($updateData);
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
      $data = SoalModel::findOrFail($Id);

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

  public function update(array $data, $StoredPath)
  {
    try {
      $updateData = [
        'Soal'            => ucfirst($data['Soal']),
        'IdUjian'         => $data['IdUjian'],
        'A'               => ucwords($data['JawabanA']),
        'B'               => ucwords($data['JawabanB']),
        'C'               => ucwords($data['JawabanC']),
        'D'               => ucwords($data['JawabanD']),
        'E'               => ucwords($data['JawabanE']),
        'Kunci'           => $data['Kunci'],
        'Gambar'          => $StoredPath,
        'PosisiGambar'    => $data['PosisiGambar'],
        'Status'          => $data['Status'],
        'IdTypeUjian'     => $data['TypeUjian'],
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];
      // update
      SoalModel::where('Id', $data['kode'])->update($updateData);

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

  public function update_wp(array $data)
  {
    try {
      $updateData = [
        'Soal'            => ucfirst($data['Soal']),
        'IdUjian'         => $data['IdUjian'],
        'A'               => ucwords($data['JawabanA']),
        'B'               => ucwords($data['JawabanB']),
        'C'               => ucwords($data['JawabanC']),
        'D'               => ucwords($data['JawabanD']),
        'E'               => ucwords($data['JawabanE']),
        'Kunci'           => $data['Kunci'],
        'PosisiGambar'    => $data['PosisiGambar'],
        'Status'          => $data['Status'],
        'IdTypeUjian'     => $data['TypeUjian'],
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];
      // update
      SoalModel::where('Id', $data['kode'])->update($updateData);

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

  public function update_warna(array $data, $StoredPath)
  {
    try {
      $updateData = [
        'IdUjian'         => $data['IdUjianWarna'],
        'Kunci'           => $data['KunciWarna'],
        'PosisiGambar'    => $data['PosisiGambarWarna'],
        'Status'          => $data['StatusWarna'],
        'IdTypeUjian'     => $data['TypeUjianWarna'],
        'Gambar'          => $StoredPath,
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];
      // update
      SoalModel::where('Id', $data['kode'])->update($updateData);

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

  public function update_wp_warna(array $data)
  {
    try {
      $updateData = [
        'IdUjian'         => $data['IdUjianWarna'],
        'Kunci'           => $data['KunciWarna'],
        'PosisiGambar'    => $data['PosisiGambarWarna'],
        'Status'          => $data['StatusWarna'],
        'IdTypeUjian'     => $data['TypeUjianWarna'],
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];

      // update
      SoalModel::where('Id', $data['kode'])->update($updateData);

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
      $Soal = SoalModel::findOrFail($Id);
      if ($Soal->Gambar == null || $Soal->Gambar == '') {
        SoalModel::where('Id', $Id)->delete();

        return [
          'success' => true,
          'message' => 'Data berhasil dihapus.'
        ];
      } else {
        $Dokumen    = SoalModel::findOrFail($Id);
        $OldDokumen = $Dokumen->Gambar;
        File::delete($OldDokumen);
        $Dokumen->delete();

        SoalModel::where('Id', $Id)->delete();
      }
    } catch (\Exception $e) {
      return [
        'success' => false,
        'message' => 'Gagal menghapus data: ' . $e->getMessage()
      ];
    }
  }
}
