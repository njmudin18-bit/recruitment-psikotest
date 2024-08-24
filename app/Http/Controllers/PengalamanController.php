<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengalamanModel;
use App\Services\PengalamanService;
use Validator;

class PengalamanController extends Controller
{
  protected $pengalamanService;

  public function __construct(PengalamanService $pengalamanService)
  {
    $this->middleware('can:read pengalaman');
    $this->pengalamanService = $pengalamanService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Pengalaman Kerja";
    if ($request->ajax()) {
      return $this->pengalamanService->dataTable();
    }

    return view('pengalaman.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Perusahaan'  => 'required|string',
      'Posisi'      => 'required|string',
      'StartDate'   => 'required|date',
      'EndDate'     => 'required|date'
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

    $result = $this->pengalamanService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pengalamanService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Perusahaan'  => 'required|string',
      'Posisi'      => 'required|string',
      'StartDate'   => 'required|date',
      'EndDate'     => 'required|date'
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

    $result = $this->pengalamanService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pengalamanService->destroy($Id);

    return response()->json($result);
  }
}
