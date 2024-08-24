<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SaudaraModel;
use App\Services\SaudaraService;
use Validator;

class SaudaraController extends Controller
{
  protected $saudaraService;

  public function __construct(SaudaraService $saudaraService)
  {
    $this->middleware('can:read keluarga');
    $this->saudaraService = $saudaraService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Data Saudara";
    if ($request->ajax()) {
      return $this->saudaraService->dataTable();
    }

    //return view('identitas.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaSaudara'            => 'required|string',
      'JkSaudara'              => 'required|string',
      'TempatLahirSaudara'     => 'required|string',
      'TanggalLahirSaudara'    => 'required|string',
      'PendidikanSaudara'      => 'required|string',
      'PekerjaanSaudara'       => 'required|string'
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

    $result = $this->saudaraService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->saudaraService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaSaudara'            => 'required|string',
      'JkSaudara'              => 'required|string',
      'TempatLahirSaudara'     => 'required|string',
      'TanggalLahirSaudara'    => 'required|string',
      'PendidikanSaudara'      => 'required|string',
      'PekerjaanSaudara'       => 'required|string'
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

    $result = $this->saudaraService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->saudaraService->destroy($Id);

    return response()->json($result);
  }
}
