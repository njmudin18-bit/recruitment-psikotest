<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TambahansatuModel;
use App\Services\TambahansatuService;
use Validator;

class TambahansatuController extends Controller
{
  //
  protected $tambahansatuService;

  public function __construct(TambahansatuService $tambahansatuService)
  {
    $this->middleware('can:read catatan');
    $this->tambahansatuService = $tambahansatuService;
  }

  public function index(Request $request)
  {
    $Title    = "Pelamar";
    $SubTitle = "Tambahan Lainnya";
    if ($request->ajax()) {
      return $this->tambahansatuService->dataTable();
    }

    return view('catatan.lainnya', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'WaktuTambahanSatu' => 'required|string'
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

    $result = $this->tambahansatuService->store($request->all());

    return $result;
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->tambahansatuService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'WaktuTambahanSatu' => 'required|string'
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

    $result = $this->tambahansatuService->update($request->all());

    return $result;
  }

  public function hapus(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->tambahansatuService->destroy($Id);

    return response()->json($result);
  }
}
