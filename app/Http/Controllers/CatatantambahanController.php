<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatatantambahanModel;
use App\Services\CatatantambahanService;
use Validator;

class CatatantambahanController extends Controller
{
  protected $catatantambahanService;

  public function __construct(CatatantambahanService $catatantambahanService)
  {
    $this->middleware('can:read catatan');
    $this->catatantambahanService = $catatantambahanService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Catatan Tambahan";
    if ($request->ajax()) {
      return $this->catatantambahanService->dataTable();
    }

    return view('catatan.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Keterangan'  => 'required|string'
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

    $result = $this->catatantambahanService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->catatantambahanService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Keterangan'  => 'required|string'
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

    $result = $this->catatantambahanService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->catatantambahanService->destroy($Id);

    return response()->json($result);
  }
}