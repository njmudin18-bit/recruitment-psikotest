<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KontakdaruratModel;
use App\Services\KontakService;
use Validator;

class KontakdaruratController extends Controller
{
  protected $kontakService;

  public function __construct(KontakService $kontakService)
  {
    $this->middleware('can:read keluarga');
    $this->kontakService = $kontakService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Kontak Darurat";
    if ($request->ajax()) {
      return $this->kontakService->dataTable();
    }

    //return view('identitas.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaKontak'        => 'required|string',
      'HubunganKontak'    => 'required|string',
      'AlamatKontak'      => 'required|string',
      'NoHpKontak'        => 'required|string'
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

    $result = $this->kontakService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->kontakService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaKontak'        => 'required|string',
      'HubunganKontak'    => 'required|string',
      'AlamatKontak'      => 'required|string',
      'NoHpKontak'        => 'required|string'
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

    $result = $this->kontakService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->kontakService->destroy($Id);

    return response()->json($result);
  }
}
