<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrangtuaModel;
use App\Services\OrangtuaService;
use Validator;

class OrangtuaController extends Controller
{
  protected $orangtuaService;

  public function __construct(OrangtuaService $orangtuaService)
  {
    $this->middleware('can:read keluarga');
    $this->orangtuaService = $orangtuaService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Data Orangtua";
    if ($request->ajax()) {
      return $this->orangtuaService->dataTable();
    }

    //return view('identitas.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaOrangtua'            => 'required|string',
      'JkOrangtua'              => 'required|string',
      'TempatLahirOrangtua'     => 'required|string',
      'TanggalLahirOrangtua'    => 'required|string',
      'PendidikanOrangtua'      => 'required|string',
      'PekerjaanOrangtua'       => 'required|string',
      'AlamatOrangtua'          => 'required|string'
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

    $result = $this->orangtuaService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->orangtuaService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaOrangtua'            => 'required|string',
      'JkOrangtua'              => 'required|string',
      'TempatLahirOrangtua'     => 'required|string',
      'TanggalLahirOrangtua'    => 'required|string',
      'PendidikanOrangtua'      => 'required|string',
      'PekerjaanOrangtua'       => 'required|string',
      'AlamatOrangtua'          => 'required|string'
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

    $result = $this->orangtuaService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->orangtuaService->destroy($Id);

    return response()->json($result);
  }
}
