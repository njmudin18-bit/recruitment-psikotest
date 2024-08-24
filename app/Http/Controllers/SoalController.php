<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel;
use App\Models\NamaujianModel;
use App\Models\TypeujianModel;
use App\Services\SoalService;
use Illuminate\Support\Facades\URL;
use Validator;
use Storage;
use File;
use Auth;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class SoalController extends Controller
{
  protected $soalService;

  public function __construct(SoalService $soalService)
  {
    $this->middleware('can:read ujian');
    $this->soalService = $soalService;
  }

  public function index(Request $request)
  {
    $Title      = "Psikotest";
    $SubTitle   = "Tambahkan soal";
    $Id         = $request->id;
    $Ujian      = NamaujianModel::where('id', $Id)->first();
    $Type       = TypeujianModel::where('Status', 'AKTIF')->orderBy('Urutan', 'ASC')->get();
    $TypeWarna  = TypeujianModel::where('Status', 'AKTIF')->where('Nama', 'Tes Buta Warna')->orderBy('Urutan', 'ASC')->get();
    $TypeSoal   = TypeujianModel::where('Status', 'AKTIF')->where('Nama', '!=', 'Tes Buta Warna')->orderBy('Urutan', 'ASC')->get();
    if ($request->ajax()) {
      return $this->soalService->dataTable($Id);
    }

    return view('psikotest.soal', compact('Title', 'SubTitle', 'Ujian', 
                                          'Type', 'Id', 'TypeWarna', 'TypeSoal'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Soal'        => 'required|string',
      'JawabanA'    => 'required|string',
      'JawabanB'    => 'required|string',
      'JawabanC'    => 'required|string',
      'JawabanD'    => 'required|string',
      // 'JawabanE'    => 'required|string',
      'Kunci'       => 'required|string',
      'Status'      => 'required|string',
      'TypeUjian'   => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $File = $request->file('file');
    if ($File) {
      $FileName     = time()."-".$File->getClientOriginalName();
      $FileExt      = $File->getClientOriginalExtension();
      $FileSize     = $File->getSize() / 1024;
      $FileMime     = $File->getMimeType();
      if ($FileExt == 'png' || $FileExt == 'jpg') {
        if ($FileSize <= 2048) {
          $Path       = "soalx";
          $File->move($Path, $FileName);
          $StoredPath = $Path."/".$FileName;
          $result     = $this->soalService->store($request->all(), $StoredPath);

          return $result;
        } else {
          return response()->json(
            [
              'success'       => false,
              'message'       => 'Ukuran file upload maximal 2MB.',
              'status_code'   => 422
            ], 422
          );
        }
      } else {
        return response()->json(
          [
            'success'       => false,
            'message'       => 'File upload yang diijinkan hanya png dan pdf.',
            'status_code'   => 422
          ], 422
        );
      }
    } else {
      $result = $this->soalService->store_wp($request->all());

      return $result;
    }
  }

  public function save_test_warna(Request $request) {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'KunciWarna'      => 'required|string',
      'StatusWarna'     => 'required|string',
      'TypeUjianWarna'  => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $File = $request->file('file');
    if ($File) {
      $FileName     = time()."-".$File->getClientOriginalName();
      $FileExt      = $File->getClientOriginalExtension();
      $FileSize     = $File->getSize() / 1024;
      $FileMime     = $File->getMimeType();
      if ($FileExt == 'png' || $FileExt == 'jpg') {
        if ($FileSize <= 2048) {
          $Path       = "soalx";
          $File->move($Path, $FileName);
          $StoredPath = $Path."/".$FileName;
          $result     = $this->soalService->store_warna($request->all(), $StoredPath);

          return $result;
        } else {
          return response()->json(
            [
              'success'       => false,
              'message'       => 'Ukuran file upload maximal 2MB.',
              'status_code'   => 422
            ], 422
          );
        }
      } else {
        return response()->json(
          [
            'success'       => false,
            'message'       => 'File upload yang diijinkan hanya png dan jpg.',
            'status_code'   => 422
          ], 422
        );
      }
    } else {
      return response()->json(
        [
          'success'       => false,
          'message'       => 'No file selected!',
          'status_code'   => 422
        ], 422
      );
    }
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->soalService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Soal'        => 'required|string',
      'JawabanA'    => 'required|string',
      'JawabanB'    => 'required|string',
      'JawabanC'    => 'required|string',
      'JawabanD'    => 'required|string',
      //'JawabanE'    => 'required|string',
      'Kunci'       => 'required|string',
      'Status'      => 'required|string',
      'TypeUjian'   => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $File         = $request->file('file');
    if ($File) {
      $FileExt      = $File->getClientOriginalExtension();
      $FileSize     = $File->getSize() / 1024;
      $FileMime     = $File->getMimeType();
      $FileName     = time()."-".$File->getClientOriginalName();

      if ($FileExt == 'png' || $FileExt == 'jpg') {
        if ($FileSize <= 2048) {
          $Id         = $request->input('kode');
          $Dokumen    = SoalModel::findOrFail($Id);
          $OldDokumen = $Dokumen->Gambar;
          File::delete($OldDokumen);
          $Dokumen->delete();

          $Path       = "soalx";
          $File->move($Path, $FileName);
          $StoredPath = $Path."/".$FileName;
          $result     = $this->soalService->update($request->all(), $StoredPath);

          return $result;
        } else {
          return response()->json(
            [
              'success'       => false,
              'message'       => 'Ukuran file upload maximal 2MB.',
              'status_code'   => 422
            ], 422
          );
        }
      } else {
        return response()->json(
          [
            'success'       => false,
            'message'       => 'File upload yang diijinkan hanya png dan jpg.',
            'status_code'   => 422
          ], 422
        );
      }
    } else {
      $result = $this->soalService->update_wp($request->all());

      return $result;
    }
  }

  public function update_test_warna(Request $request) {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'KunciWarna'      => 'required|string',
      'StatusWarna'     => 'required|string',
      'TypeUjianWarna'  => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $File         = $request->file('file');
    if ($File) {
      $FileExt      = $File->getClientOriginalExtension();
      $FileSize     = $File->getSize() / 1024;
      $FileMime     = $File->getMimeType();
      $FileName     = time()."-".$File->getClientOriginalName();

      if ($FileExt == 'png' || $FileExt == 'jpg') {
        if ($FileSize <= 2048) {
          $Id         = $request->input('kode');
          $Dokumen    = SoalModel::findOrFail($Id);
          $OldDokumen = $Dokumen->Gambar;
          File::delete($OldDokumen);
          $Dokumen->delete();

          $Path       = "soalx";
          $File->move($Path, $FileName);
          $StoredPath = $Path."/".$FileName;
          $result     = $this->soalService->update_warna($request->all(), $StoredPath);

          return $result;
        } else {
          return response()->json(
            [
              'success'       => false,
              'message'       => 'Ukuran file upload maximal 2MB.',
              'status_code'   => 422
            ], 422
          );
        }
      } else {
        return response()->json(
          [
            'success'       => false,
            'message'       => 'File upload yang diijinkan hanya png dan jpg.',
            'status_code'   => 422
          ], 422
        );
      }
    } else {
      $result = $this->soalService->update_wp_warna($request->all());

      return $result;
    }
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->soalService->destroy($Id);

    return response()->json($result);
  }

  public function import_soal(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'TypeUjian'         => 'required|string',
      'StatusImportSoal'  => 'required|string'
    ]);

    if ($validator->fails()) {
      return response()->json(
        [
          'error_string'  => $validator->errors()->all(),
          'inputerror'    => $validator->errors()->keys(),
          'status_code'   => 500
        ], 500
      );
    }

    $file         = $request->file('file');
    $path         = $file->storeAs('temp', 'imported-file.' . $file->extension());
    $spreadsheet  = IOFactory::load(Storage::path($path));
    $sheet        = $spreadsheet->getActiveSheet();
    $data         = $sheet->toArray();
    $SaveData     = array();
    // Optionally, remove the temporary file
    Storage::delete($path);

    // Skip header row if you have one
    array_shift($data);

    foreach ($data as $row) {
      $SaveData[] = [
        'Soal'          => $row[1],
        'Kunci'         => $row[2],
        'A'             => $row[3],
        'B'             => $row[4],
        'C'             => $row[5],
        'D'             => $row[6],
        'E'             => $row[7],
        'Status'        => $request->input('StatusImportSoal'),
        'PosisiGambar'  => 'None',
        'IdTypeUjian'   => $request->input('TypeUjian'),
        'IdUjian'       => $request->input('IdUjian'),
        'CreatedDate'   => date('Y-m-d H:i:s'),
        'CreatedBy'     => Auth::user()->id
      ];
    }

    // Define batch size
    $batchSize = 1000;

    // Insert in batches
    foreach (array_chunk($SaveData, $batchSize) as $batch) {
      DB::table('trans_soal')->insert($batch);
    }

    return response()->json([
      'status_code' => 200,
      'status'      => "success",
      'message'     => "Data berhasil disimpan",
      'data'        => $SaveData
    ], 200);
  }
}
