<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HasilujianModel;
use App\Services\HasilpsikotestService;
use Illuminate\Support\Facades\URL;
use Validator;
use Storage;
use File;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HasilpsikotestController extends Controller
{
  protected $hasilpsikotestService;

  public function __construct(HasilpsikotestService $hasilpsikotestService)
  {
    $this->middleware('can:read hasil');
    $this->hasilpsikotestService = $hasilpsikotestService;
  }

  public function index(Request $request)
  {
    $Title    = "Laporan";
    $SubTitle = "Hasil Psikotest";
    if ($request->ajax()) {
      $StarDate = $request->input('start_date');
      $EndDate  = $request->input('end_date');
      return $this->hasilpsikotestService->dataTable($StarDate, $EndDate);
    }

    return view('report.hasil_psikotest', compact('Title', 'SubTitle'));
  }

  public function hapus(Request $request)
  {
    $Id     = $request->input('UjianID');
    $result = $this->hasilpsikotestService->destroy($Id);

    return response()->json($result);
  }
}
