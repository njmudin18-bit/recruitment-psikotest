<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasanganModel;
use App\Services\PasanganService;
use Validator;

class KeluargaController extends Controller
{
  protected $pasanganService;

  public function __construct(PasanganService $pasanganService)
  {
    $this->middleware('can:read keluarga');
    $this->pasanganService = $pasanganService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Keluarga & Lingkungan";
    if ($request->ajax()) {
      return $this->pasanganService->dataTable();
    }

    return view('pasangan.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaPasangan'          => 'required|string',
      'JkPasangan'            => 'required|string',
      'TempatLahirPasangan'   => 'required|string',
      'TanggalLahirPasangan'  => 'required|string',
      'PendidikanPasangan'    => 'required|string',
      'PekerjaanPasangan'     => 'required|string',
      'PerusahaanPasangan'    => 'required|string',
      'JabatanPasangan'       => 'required|string',
      'EmailPasangan'         => 'required|email',
      'NoHpPasangan'          => 'required|numeric',
      'AlamatPasangan'        => 'required|string',
      'SosmedPasangan'        => 'required|string'
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

    $result = $this->pasanganService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pasanganService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'NamaPasangan'          => 'required|string',
      'JkPasangan'            => 'required|string',
      'TempatLahirPasangan'   => 'required|string',
      'TanggalLahirPasangan'  => 'required|string',
      'PendidikanPasangan'    => 'required|string',
      'PekerjaanPasangan'     => 'required|string',
      'PerusahaanPasangan'    => 'required|string',
      'JabatanPasangan'       => 'required|string',
      'EmailPasangan'         => 'required|email',
      'NoHpPasangan'          => 'required|numeric',
      'AlamatPasangan'        => 'required|string',
      'SosmedPasangan'        => 'required|string'
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

    $result = $this->pasanganService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->pasanganService->destroy($Id);

    return response()->json($result);
  }
}
