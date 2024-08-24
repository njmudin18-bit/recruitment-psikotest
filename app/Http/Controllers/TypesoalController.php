<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeujianModel;
use App\Services\TypeujianService;
use Validator;

class TypesoalController extends Controller
{
  protected $typeujianService;

  public function __construct(TypeujianService $typeujianService)
  {
    $this->middleware('can:read type');
    $this->typeujianService = $typeujianService;
  }

  public function index(Request $request)
  {
    $Title    = "Psikotest";
    $SubTitle = "Type Ujian";
    if ($request->ajax()) {
      return $this->typeujianService->dataTable();
    }

    return view('psikotest.type', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Nama'        => 'required|string',
      'Urutan'      => 'required|int',
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

    $result = $this->typeujianService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->typeujianService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Nama'        => 'required|string',
      'Urutan'      => 'required|int',
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

    $result = $this->typeujianService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->typeujianService->destroy($Id);

    return response()->json($result);
  }
}
