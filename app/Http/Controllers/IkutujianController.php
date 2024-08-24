<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel;
use App\Models\NamaujianModel;
use App\Models\TypeujianModel;
use App\Models\HasilujianModel;
use App\Models\IdentitaspribadiModel;
use App\Services\SoalService;
use App\Services\NamaujianService;
use Illuminate\Support\Facades\URL;
use Validator;
use Storage;
use File;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IkutujianController extends Controller
{
  protected $soalService;
  protected $namaujianService;

  public function __construct(SoalService $soalService, NamaujianService $namaujianService)
  {
    $this->middleware('can:read ikuti');
    $this->soalService      = $soalService;
    $this->namaujianService = $namaujianService;
  }

  public function index(Request $request)
  {
    $Title    = "Psikotest";
    $SubTitle = "Ikuti Ujian";
    $Id       = $request->id;
    if ($request->ajax()) {
      return $this->namaujianService->DaftarUjian();
    }

    return view('psikotest.ikut', compact('Title', 'SubTitle'));
  }

  public function check_biodata(Request $request)
  {
    $UserId = $request->input('UserId');
    $Check  = IdentitaspribadiModel::where('CreatedBy', $UserId)->count();
    if ($Check > 0) {
      return response()->json(
        [
          'status_code'   => 200,
          'status'        => 'success',
          'message'       => 'Data identitas pribadi sudah terisi, anda akan diarahkan ke halaman ujian.'
        ], 200
      );
    } else {
      return response()->json(
        [
          'status_code'   => 404,
          'status'        => 'error',
          'message'       => 'Data identitas pribadi belum terisi, silahkan isi dan lengkapi atau tanyakan kembali ke Tim Recruitment.',
          'url'           => ''
        ], 404
      );
    }
  }

  public function check_pin(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Pin'         => 'required|string|min:6|max:6',
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

    $Today  = date('Y-m-d');
    $UserId = Auth::user()->id;
    $Id     = $request->input('kode');
    $PIN    = strtoupper($request->input('Pin'));
    $Check  = NamaujianModel::where('Pin', $PIN)->where('Id', $Id)->where('Status', 'AKTIF')->count();
    if ($Check > 0) {
      $CheckMore  = HasilujianModel::where('CreatedBy', $UserId)
                    //->where('CreatedDate', $Id)
                    ->whereRaw('DATE(CreatedDate) = ?', [$Today])
                    ->count();

      if ($CheckMore == 0) {
        $Data = NamaujianModel::where('Pin', $PIN)->where('Status', 'AKTIF')->first();
        return response()->json(
          [
            'status_code'   => 200,
            'status'        => 'success',
            'message'       => 'PIN valid, anda akan diarahkan ke halaman ujian.',
            'url'           => url('psikotest/ikut/soal/'.$Data->Id.'/'.$PIN),
            'data'          => $Data
          ], 200
        );
      } else {
        return response()->json(
          [
            'status_code'   => 409,
            'status'        => 'info',
            'message'       => 'Anda telah mengikuti ujian ini di hari ini. Silahkan dicoba dilain waktu.',
            'url'           => ''
          ], 409
        );
      }
    } else {
      return response()->json(
        [
          'status_code'   => 404,
          'status'        => 'error',
          'message'       => 'PIN tidak valid, silahkan periksa PIN atau tanyakan kembali ke tim Recruitmen.',
          'url'           => ''
        ], 404
      );
    }
  }

  public function mulai_ujian(Request $request, $Id, $Pin)
  {
    $Title    = "Psikotest";
    $SubTitle = "Ikuti Ujian";

    $Ujian          = NamaujianModel::where('id', $Id)->first();
    //dd($Ujian);
    $UjianStartDate = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    $UjianEndDate   = Carbon::createFromFormat('Y-m-d H:i:s', $Ujian->EndDate);
    $StartDate      = $UjianStartDate->format('Y/m/d H:i:s');
    $EndDate        = $UjianEndDate->format('Y/m/d H:i:s');
    //dd($StartDate, $EndDate);

    $Soal     = SoalModel::where('IdUjian', $Id)->where('Status', 'AKTIF')->get();
    $Type     = TypeujianModel::where('Status', 'AKTIF')->orderBy('Urutan', 'ASC')->get();

    return view('psikotest.mulai_ujian', compact('Title', 'SubTitle', 'Ujian', 'Soal', 
                                                 'Type', 'Id', 'Pin', 'StartDate', 'EndDate'));
  }

  public function ujian_detail(Request $request, $Id) {
    $Title    = "Psikotest";
    $SubTitle = "Detail Ujian";

    $Ujian          = NamaujianModel::where('id', $Id)->first();
    $UjianStartDate = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    $UjianEndDate   = Carbon::createFromFormat('Y-m-d H:i:s', $Ujian->StartDate);
    $StartDate      = $UjianStartDate->format('Y/m/d H:i:s');
    $EndDate        = $UjianEndDate->format('Y/m/d H:i:s');

    $UjianLiveStart = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
    $UjianLiveEnd   = Carbon::createFromFormat('Y-m-d H:i:s', $Ujian->EndDate);
    $LiveStartDate  = $UjianLiveStart->format('Y/m/d H:i:s');
    $LiveEndDate    = $UjianLiveEnd->format('Y/m/d H:i:s');
    //dd($LiveStartDate, $LiveEndDate);

    return view('psikotest.ujian_detail', compact('Title', 'SubTitle', 'Ujian', 
                'StartDate', 'EndDate', 'LiveStartDate', 'LiveEndDate'));
  }

  public function tampilkan_soal_ujian(Request $request, $Id, $Pin) {
    $Ujian = NamaujianModel::where('id', $Id)->first();
    $Soal  = SoalModel::where('IdUjian', $Id)->where('Status', 'AKTIF')->get();
    $Type  = TypeujianModel::where('Status', 'AKTIF')
            ->orderBy('Urutan', 'ASC')
            ->paginate(1); //->get();
    $Data  = array();

    foreach ($Type as $key => $value) {
      $Data[$key]['Id']         = $value->Id;
      $Data[$key]['Nama']       = $value->Nama;
      $Data[$key]['Urutan']     = $value->Urutan;
      $Data[$key]['Status']     = $value->Status;
      $Data[$key]['ContohSoal'] = $value->ContohSoal;
      $Data[$key]['Data']       = SoalModel::where('Status', 'AKTIF')->where('IdTypeUjian', $value->Id)->get();
    }

    if ($request->ajax()) {
      return response()->json([
        'data' => $Data,
        'pagination' => [
          'current_page'  => $Type->currentPage(),
          'last_page'     => $Type->lastPage(),
          'per_page'      => $Type->perPage(),
          'total'         => $Type->total(),
        ]
      ]);
    }

    // return response()->json(
    //   [
    //     'status_code'   => 200,
    //     'status'        => 'success',
    //     'message'       => 'Soal ujian sukses ditampilkan',
    //     'data'          => $Data
    //   ], 200
    // );
  }

  public function simpan_jawaban(Request $request) {
    //dd($request->all());
    $JumlahSoal = $request->input('JumlahSoalNew');
    $Pilihan    = $request->input('Pilihan');
		$IdSoal     = $request->input('IdSoal');
		$IdUjian    = $request->input('IdUjian');
    $UserId     = Auth::user()->id;
    $Now        = date('Y-m-d');

		$Score      = 0;
		$Benar      = 0;
		$Salah      = 0;
		$Kosong     = 0;
		$Hasil      = 0;

    for($i = 0; $i < $JumlahSoal; $i++){
			$Nomor = $IdSoal[$i];

      // jika user tidak memilih jawaban
			if(empty($Pilihan[$Nomor])){
				$Kosong++;
			} else {
        // jika memilih
				$Jawaban = $Pilihan[$Nomor];

        $Check   = SoalModel::where('Id', $Nomor)->where('Kunci', $Jawaban)->count();
        if($Check){
					// jika jawaban cocok (benar)
					$Benar++;
				} else {
					// jika salah
					$Salah++;
				}

        $Soal   = SoalModel::where('Status', 'AKTIF')->count();
        $Score  = 100 / $Soal * $Benar;
			  $Hasil  = number_format($Score, 2);
      }
    }

    //CHECK SUDAH ADA ATAU BELUM DIHARI YANG SAMA
    $Check = HasilujianModel::where('CreatedBy', $UserId)
              ->where(DB::raw('DATE(CreatedDate)'), $Now)
              ->count();
    if ($Check == 0) {
      $DataSave = [
        'IdUjian'      => $request->input('IdUjian'),
        'Score'        => floatval($Hasil),
        'Benar'        => floatval($Benar),
        'Salah'        => floatval($Salah),
        'Kosong'       => floatval($Kosong),
        'CreatedDate'  => date('Y-m-d H:i:s'),
        'CreatedBy'    => $UserId
      ];

      $Save = HasilujianModel::create($DataSave);
      if ($Save) {
        return response()->json(
          [
            'status_code'   => 200,
            'status'        => 'sukses',
            'message'       => 'Anda telah selesai mengerjakan ujian, terima kasih telah mengikuti proses seleksi di perusahaan kami.',
            'hasil'         => floatval($Hasil),
            'benar'         => floatval($Benar),
            'salah'         => floatval($Salah),
            'kosong'        => floatval($Kosong),
            'url'           => ''
          ], 200
        );
      } else {
        return response()->json(
          [
            'status_code'   => 500,
            'status'        => 'error',
            'message'       => 'Anda telah selesai mengerjakan ujian, terima kasih telah mengikuti proses seleksi di perusahaan kami.',
            'hasil'         => floatval($Hasil),
            'benar'         => floatval($Benar),
            'salah'         => floatval($Salah),
            'kosong'        => floatval($Kosong),
            'url'           => ''
          ], 500
        );
      }
    } else {
      return response()->json(
        [
          'status_code'   => 500,
          'status'        => 'error',
          'message'       => 'Anda telah mengikuti ujian kami, terima kasih.',
          'hasil'         => floatval($Hasil),
          'benar'         => floatval($Benar),
          'salah'         => floatval($Salah),
          'kosong'        => floatval($Kosong),
          'url'           => ''
        ], 500
      );
    }
  }
}