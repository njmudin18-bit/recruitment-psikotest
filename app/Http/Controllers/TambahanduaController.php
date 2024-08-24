<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambahanduaModel;
use App\Services\TambahanduaService;
use Validator;

class TambahanduaController extends Controller
{
  protected $tambahanduaService;

  public function __construct(TambahanduaService $tambahanduaService)
  {
    $this->middleware('can:read catatan');
    $this->tambahanduaService = $tambahanduaService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Catatan Tambahan Dua";
    if ($request->ajax()) {
      return $this->tambahanduaService->dataTable();
    }

    //return view('catatan.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'InstansiTambahanDua' => 'required|string',
      'WaktuTambahanDua'    => 'required|string'
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

    $result = $this->tambahanduaService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->tambahanduaService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'InstansiTambahanDua' => 'required|string',
      'WaktuTambahanDua'    => 'required|string'
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

    $result = $this->tambahanduaService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->tambahanduaService->destroy($Id);

    return response()->json($result);
  }
}
