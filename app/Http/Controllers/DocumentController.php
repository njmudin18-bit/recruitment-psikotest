<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DocumentModel;
use App\Services\DocumentService;
use Illuminate\Support\Facades\URL;
use Validator;
use Storage;
use File;
use Auth;
use Carbon\Carbon;
use Telegram\Bot\Laravel\Facades\Telegram;

class DocumentController extends Controller
{
  protected $documentService;

  public function __construct(DocumentService $documentService)
  {
    $this->middleware('can:read dokumen');
    $this->documentService = $documentService;
  }

  public function index(Request $request, $month = null, $year = null)
  {
    // $activity = Telegram::getUpdates();
    // dd($activity);

    $Title    = "Pelamar";
    $SubTitle = "Upload Dokumen";
    if ($request->ajax()) {
      return $this->documentService->dataTable();
    }

    return view('document.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request, $month = null, $year = null)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaDokumen'  => 'required|string',
      'TypeDokumen'  => 'required|string'
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
      $TypeDokumen  = $request->input('TypeDokumen');
      $FileExt      = $File->getClientOriginalExtension();
      $FileSize     = $File->getSize() / 1024;
      $FileMime     = $File->getMimeType();
      $FileName     = $TypeDokumen."-".time()."-".Auth::user()->name.".".$FileExt;
      if ($FileExt == 'png' || $FileExt == 'pdf') {
        if ($FileSize <= 2048) {
          //CEK BIAR GAK ADA USER 2 KALI UPLOAD FILE YG SAMA
          if ($TypeDokumen == 'Lamaran') {

            $month      = $month ?: now()->month;
            $year       = $year ?: now()->year;
            $StartDate  = Carbon::createFromDate($year, $month, 1);
            $EndDate    = $StartDate->copy()->endOfMonth();

            $Cek        = DocumentModel::where('CreatedBy', Auth::user()->id)
                          ->where('TypeDokumen', $TypeDokumen)
                          ->whereBetween('CreatedDate', [$StartDate, $EndDate])
                          ->count();
            if ($Cek == 0) {
              $Path       = "doxx";
              $File->move($Path, $FileName);
              $StoredPath = $Path."/".$FileName;
              $result     = $this->documentService->store($request->all(), $StoredPath, $FileExt, $FileSize);

              $URL    = URL::to('/')."/identitas-preview/".Auth::user()->id;
              $text   = "<b>== INFO LAMARAN BARU ==</b> \n\n";
              $text  .= "Halo HRD team, ada lamaran baru dari: \n";
              $text  .= "Nama: <b>".Auth::user()->name."</b> \n";
              $text  .= "Email: <b>".Auth::user()->email."</b> \n";
              $text  .= "Selengkapnya: <a href='".$URL."'>Klik disini</a> \n\n";
              $text  .= "Sekian dan terima kasih.\n";
              $text  .= "<i>Dikirim dari system <a href='".URL::to('/')."'>e-Recruitment</a>.</i>";

              Telegram::sendMessage([
                'chat_id'       => env('TELEGRAM_CHANNEL_ID', ''),
                'parse_mode'    => 'HTML',
                'text'          => $text
              ]);

              return $result;
            } else {
              return response()->json([
                'status_code' => 409,
                'status'      => "error",
                'message'     => "Anda telah mengirimkan surat lamaran dibulan ini, 
                                  silahkan cek atau hapus dahulu file yang sudah anda upload sebelumnya, dibulan ini."
              ], 409);
            }
          } else {
            $Cek        = DocumentModel::where('CreatedBy', Auth::user()->id)->where('TypeDokumen', $TypeDokumen)->count();
            if ($Cek == 0) {
              $Path       = "doxx";
              $File->move($Path, $FileName);
              $StoredPath = $Path."/".$FileName;
              $result     = $this->documentService->store($request->all(), $StoredPath, $FileExt, $FileSize);

              return $result;
            } else {
              return response()->json(
                [
                  'success'       => false,
                  'message'       => 'File '.$TypeDokumen.' sudah ada!',
                  'status_code'   => 422
                ], 422
              );
            }
          }
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
    $result = $this->documentService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaDokumen'  => 'required|string',
      'TypeDokumen'  => 'required|string'
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
    $TypeDokumen  = $request->input('TypeDokumen');
    $Cek          = DocumentModel::where('CreatedBy', Auth::user()->id)->where('TypeDokumen', $TypeDokumen)->count();
    if ($File) {
      $TypeDokumen  = $request->input('TypeDokumen');
      $FileExt      = $File->getClientOriginalExtension();
      $FileSize     = $File->getSize() / 1024;
      $FileMime     = $File->getMimeType();
      $FileName     = $request->input('TypeDokumen')."-".time()."-".Auth::user()->name.".".$FileExt;

      if ($FileExt == 'png' || $FileExt == 'pdf') {
        if ($FileSize <= 2048) {

          $Id         = $request->input('kode');
          $Dokumen    = DocumentModel::findOrFail($Id);
          $OldDokumen = $Dokumen->File;
          File::delete($OldDokumen);
          $Dokumen->delete();

          $Path       = "doxx";
          $File->move($Path, $FileName);
          $StoredPath = $Path."/".$FileName;
          $result     = $this->documentService->update($request->all(), $StoredPath, $FileExt, $FileSize);

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
      $result = $this->documentService->updateWF($request->all());

      return $result;
    }
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->documentService->destroy($Id);

    return response()->json($result);
  }
}
