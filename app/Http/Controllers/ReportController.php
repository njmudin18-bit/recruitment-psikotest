<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdentitaspribadiModel;
use App\Models\DocumentModel;
use App\Services\IdentitaspribadiService;

class ReportController extends Controller
{
  public function __construct(IdentitaspribadiService $identitaspribadiService)
  {
    $this->middleware('can:read report');
    $this->identitaspribadiService  = $identitaspribadiService;
  }

  public function index(Request $request)
  {
    // dd(Auth::user()->roles[0]->name); PAKE INI UNTUK USER PELAMAR
    $Title      = "Report";
    $SubTitle   = "Data Pelamar";

    return view('report.index', compact('Title', 'SubTitle'));
  }

  public function list(Request $request)
  {
    $StartDate  = $request->post('start_date');
    $EndDate    = $request->post('end_date');
    if ($request->ajax()) {
      return $this->identitaspribadiService->report($StartDate, $EndDate);
    }
  }

  public function document_list(Request $request) {
    $UserID  = $request->post('UserID');
    if ($request->ajax()) {
      return $this->identitaspribadiService->document_list($UserID);
    }
  }

  public function hapus_semua_data_user(Request $request) {
    $UserID  = $request->post('UserID');
    if ($request->ajax()) {
      return $this->identitaspribadiService->hapus_semua_data_user($UserID);
    }
  }
}
