<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnakModel;
use App\Services\AnakService;
use Validator;

class AnakController extends Controller
{
  protected $anakService;

  public function __construct(AnakService $anakService)
  {
    $this->middleware('can:read keluarga');
    $this->anakService = $anakService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Data Anak";
    if ($request->ajax()) {
      return $this->anakService->dataTable();
    }

    //return view('identitas.index', compact('Title', 'SubTitle'));
  }

  public function create(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->anakService->show($Id);

    return $result;
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaAnak'            => 'required|string',
      'JkAnak'              => 'required|string',
      'TempatLahirAnak'     => 'required|string',
      'TanggalLahirAnak'    => 'required|string',
      'PendidikanAnak'      => 'required|string',
      'PekerjaanAnak'       => 'required|string'
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

    $result = $this->anakService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->anakService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaAnak'            => 'required|string',
      'JkAnak'              => 'required|string',
      'TempatLahirAnak'     => 'required|string',
      'TanggalLahirAnak'    => 'required|string',
      'PendidikanAnak'      => 'required|string',
      'PekerjaanAnak'       => 'required|string'
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

    $result = $this->anakService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->anakService->destroy($Id);

    return response()->json($result);
  }
}
