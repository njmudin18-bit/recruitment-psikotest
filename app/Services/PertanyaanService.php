<?php

namespace App\Services;
use App\Models\PertanyaanModel;
use App\Models\JawabanpertanyaanModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Auth;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PertanyaanService
{
  public function __construct()
  {
      //
  }

  public function dataTable()
  {
    $data = PertanyaanModel::select('*')->orderBy('CreatedDate', 'DESC');

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
        if (Gate::allows('update pertanyaan')) {
          $actionBtn .= '<button type="button" name="edit" onclick="edit('.$row->Id.')" class="editRole btn btn-warning btn-sm me-2" title="Edit"><i class="bx bx-edit"></i></button>';
        }
        if (Gate::allows('delete pertanyaan')) {
          $actionBtn .= '<button type="button" name="delete" onclick="hapus('.$row->Id.')" class="deleteRole btn btn-danger btn-sm" title="Hapus"><i class="bx bx-x-circle"></i></button>';
        }
        
        return '<div class="text-center">' . $actionBtn . '</div>';
      })
      ->editColumn('Pertanyaan', function ($row) {
        return $row->Pertanyaan;
      })
      ->editColumn('StatusAktivasi', function ($row) {
        return $row->StatusAktivasi == 'Aktif' ? '<span class="badge bg-success">'.strtoupper($row->StatusAktivasi).'</span>' : '<span class="badge bg-danger">'.strtoupper($row->StatusAktivasi).'</span>';
      })
      ->editColumn('CreatedBy', function ($row) {
        $user = User::find($row->CreatedBy);
        
        return $user->name;
      })
      ->rawColumns(['action', 'Pertanyaan', 'StatusAktivasi'])
      ->make(true);
  }

  public function store(array $data)
  {
    try {
      $updateData = [
        'Urutan'          => $data['Urutan'], 
        'Pertanyaan'      => $data['Pertanyaan'], 
        'StatusAktivasi'  => $data['StatusAktivasi'],
        'CreatedDate'     => date('Y-m-d H:i:s'),
        'CreatedBy'       => Auth::user()->id
      ];
      // create
      $data = PertanyaanModel::create($updateData);
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

      $data = PertanyaanModel::findOrFail($Id);

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
        'Urutan'          => $data['Urutan'],
        'Pertanyaan'      => $data['Pertanyaan'], 
        'StatusAktivasi'  => $data['StatusAktivasi'],
        'UpdatedDate'     => date('Y-m-d H:i:s'),
        'UpdatedBy'       => Auth::user()->id
      ];
      // update
      PertanyaanModel::where('Id', $data['kode'])->update($updateData);
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
      PertanyaanModel::where('Id', $Id)->delete();

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

  public function listing() {
    try {
      $Html   = "";
      $No     = 1;
      $UserID = Auth::user()->id;
      $Cek    = JawabanpertanyaanModel::where('CreatedBy', '=', $UserID)->count();
      if ($Cek > 0) {
        $data = JawabanpertanyaanModel::leftJoin('ms_pertanyaan as p', 'trans_jawaban_pertanyaan.KodePertanyaan', '=', 'p.Id')
                ->select('trans_jawaban_pertanyaan.*', 'p.*')
                ->where('p.StatusAktivasi', '=', 'Aktif')
                ->where('trans_jawaban_pertanyaan.CreatedBy', '=', $UserID)
                ->orderBy('p.Urutan', 'ASC')
                ->get();

        foreach ($data as $key => $value) {
          $CheckedYa    = $value->Jawaban == 'Ya' ? 'checked' : '';
          $CheckedTidak = $value->Jawaban == 'Tidak' ? 'checked' : '';
          $Html .= '<tr>
                      <td class="text-end">'.$No.'</td>
                      <td class="text-center">
                        <div class="form-check form-radio-primary">
                          <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Ya" '.$CheckedYa.'>
                        </div>
                      </td>
                      <td class="text-center">
                        <div class="form-check form-radio-danger">
                          <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Tidak" '.$CheckedTidak.'>
                        </div>
                      </td>
                      <td class="text-start">
                        <input name="KodePertanyaan[]" id="KodePertanyaan_'.$No.'" type="hidden" value="'.$value->Id.'" >
                        '.$value->Pertanyaan.'
                        <hr>
                        <textarea name="Penjelasan[]" id="Penjelasan_'.$No.'" maxlength="255" class="form-control" rows="1" placeholder="Jelaskan jawaban No. '.$No.' disini">'.$value->Penjelasan.'</textarea>
                        <small class="text-danger">Max: 255 characters</small>
                      </td>
                    </tr>';
          $No++;
        }
      } else {
        $data   = PertanyaanModel::where('StatusAktivasi', '=', 'Aktif')->orderBy('Urutan', 'ASC')->get();

        foreach ($data as $key => $value) {
          $Html .= '<tr>
                      <td class="text-end">'.$No.'</td>
                      <td class="text-center">
                        <div class="form-check form-radio-primary">
                          <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Ya">
                        </div>
                      </td>
                      <td class="text-center">
                        <div class="form-check form-radio-danger">
                          <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Tidak">
                        </div>
                      </td>
                      <td class="text-start">
                        <input name="KodePertanyaan[]" id="KodePertanyaan_'.$No.'" type="hidden" value="'.$value->Id.'" >
                        '.$value->Pertanyaan.'
                        <hr>
                        <textarea name="Penjelasan[]" id="Penjelasan_'.$No.'" maxlength="255" class="form-control" rows="1" placeholder="Jelaskan jawaban No. '.$No.' disini"></textarea>
                        <small class="text-danger">Max: 255 characters</small>
                      </td>
                    </tr>';
          $No++;
        }
      }

      return response()->json([
        'status_code' => 200,
        'status'      => "success",
        'message'     => "Data berhasil ditampilkan",
        'data'        => $data,
        'html'        => $Html
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

  public function dijawab(array $data) {
    try {
      $UserID = Auth::user()->id;
      $Cek    = JawabanpertanyaanModel::where('CreatedBy', '=', $UserID)->count();
      if ($Cek > 0) {
        JawabanpertanyaanModel::where('CreatedBy', $UserID)->delete();
      }

      $InsertData = array();
      $No         = 1;
      foreach ($data['KodePertanyaan'] as $key => $value) {
        $InsertData[] = array(
          'KodePertanyaan'  => $value,
          'Penjelasan'      => $data['Penjelasan'][$key],
          'Jawaban'         => $data['Jawaban_'.$No],
          'CreatedDate'     => date('Y-m-d H:i:s'),
          'CreatedBy'       => Auth::user()->id
        );
        $No++;
      }
      // create
      $data = JawabanpertanyaanModel::insert($InsertData);
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

  public function showByUser($id) {
    $Html   = "";
    $No     = 1;
    $UserID = $id;
    $Cek    = JawabanpertanyaanModel::where('CreatedBy', '=', $UserID)->count();
    if ($Cek > 0) {
      $data = JawabanpertanyaanModel::leftJoin('ms_pertanyaan as p', 'trans_jawaban_pertanyaan.KodePertanyaan', '=', 'p.Id')
              ->select('trans_jawaban_pertanyaan.*', 'p.*')
              ->where('p.StatusAktivasi', '=', 'Aktif')
              ->where('trans_jawaban_pertanyaan.CreatedBy', '=', $UserID)
              ->orderBy('p.Urutan', 'ASC')
              ->get();

      // foreach ($data as $key => $value) {
      //   $CheckedYa    = $value->Jawaban == 'Ya' ? 'checked' : '';
      //   $CheckedTidak = $value->Jawaban == 'Tidak' ? 'checked' : '';
      //   $Html .= '<tr>
      //               <td class="text-end">'.$No.'</td>
      //               <td class="text-center">
      //                 <div class="form-check form-radio-primary">
      //                   <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Ya" '.$CheckedYa.'>
      //                 </div>
      //               </td>
      //               <td class="text-center">
      //                 <div class="form-check form-radio-danger">
      //                   <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Tidak" '.$CheckedTidak.'>
      //                 </div>
      //               </td>
      //               <td class="text-start">
      //                 <input name="KodePertanyaan[]" id="KodePertanyaan_'.$No.'" type="hidden" value="'.$value->Id.'" >
      //                 '.$value->Pertanyaan.'
      //                 <hr>
      //                 <textarea name="Penjelasan[]" id="Penjelasan_'.$No.'" maxlength="255" class="form-control" rows="1" placeholder="Jelaskan jawaban No. '.$No.' disini">'.$value->Penjelasan.'</textarea>
      //                 <small class="text-danger">Max: 255 characters</small>
      //               </td>
      //             </tr>';
      //   $No++;
      // }
    } else {
      $data   = PertanyaanModel::where('StatusAktivasi', '=', 'Aktif')->orderBy('Urutan', 'ASC')->get();

      // foreach ($data as $key => $value) {
      //   $Html .= '<tr>
      //               <td class="text-end">'.$No.'</td>
      //               <td class="text-center">
      //                 <div class="form-check form-radio-primary">
      //                   <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Ya">
      //                 </div>
      //               </td>
      //               <td class="text-center">
      //                 <div class="form-check form-radio-danger">
      //                   <input class="form-check-input" type="radio" name="Jawaban_'.$No.'" id="Jawaban_'.$No.'" value="Tidak">
      //                 </div>
      //               </td>
      //               <td class="text-start">
      //                 <input name="KodePertanyaan[]" id="KodePertanyaan_'.$No.'" type="hidden" value="'.$value->Id.'" >
      //                 '.$value->Pertanyaan.'
      //                 <hr>
      //                 <textarea name="Penjelasan[]" id="Penjelasan_'.$No.'" maxlength="255" class="form-control" rows="1" placeholder="Jelaskan jawaban No. '.$No.' disini"></textarea>
      //                 <small class="text-danger">Max: 255 characters</small>
      //               </td>
      //             </tr>';
      //   $No++;
      // }
    }

    return $data;
  }
}
