<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeujianModel;
use App\Services\NamaujianService;
use Validator;

class NamaujianController extends Controller
{
  protected $namaujianService;

  public function __construct(NamaujianService $namaujianService)
  {
    $this->middleware('can:read ujian');
    $this->namaujianService = $namaujianService;
  }

  public function index(Request $request)
  {
    $Title    = "Psikotest";
    $SubTitle = "Nama Ujian";
    if ($request->ajax()) {
      return $this->namaujianService->dataTable();
    }

    return view('psikotest.nama_ujian', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Nama'        => 'required|string',
      'Acak'        => 'required|string',
      'Durasi'      => 'required|int',
      'Score'       => 'required|int',
      'StartDate'   => 'required|string',
      'EndDate'     => 'required|string',
      'Status'      => 'required|string'
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

    $result = $this->namaujianService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->namaujianService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Nama'        => 'required|string',
      'Acak'        => 'required|string',
      'Durasi'      => 'required|int',
      'Score'       => 'required|int',
      'StartDate'   => 'required|string',
      'EndDate'     => 'required|string',
      'Status'      => 'required|string'
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

    $result = $this->namaujianService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->namaujianService->destroy($Id);

    return response()->json($result);
  }

  public function refresh_pin(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->namaujianService->refresh_pin($Id);

    return $result;
  }
}
