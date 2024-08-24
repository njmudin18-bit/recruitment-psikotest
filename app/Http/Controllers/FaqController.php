<?php

namespace App\Http\Controllers;

use App\Models\FaqModel;
use Illuminate\Http\Request;
use App\Services\FaqService;
use Validator;

class FaqController extends Controller
{
  protected $faqService;

  public function __construct(FaqService $faqService)
  {
    $this->middleware('can:read faqs');
    $this->faqService = $faqService;
  }

  public function index(Request $request)
  {
    $Title    = "Master Data";
    $SubTitle = "FAQs";
    if ($request->ajax()) {
      return $this->faqService->dataTable();
    }

    return view('faqs.index', compact('Title', 'SubTitle'));
  }

  public function save(Request $request)
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Pertanyaan'      => 'required',
      'Jawaban'         => 'required|string',
      'StatusAktivasi'  => 'required|string|max:5',
      'TypePertanyaan'  => 'required|string|max:2',
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

    $result = $this->faqService->store($request->all());

    return response()->json($result);
  }

  public function edit(Request $request)
  {
    $Id     = $request['id'];
    $result = $this->faqService->edit($Id);

    return $result;
  }

  public function update(Request $request) 
  {
    $input_request  = $request->input();
    $validator      = Validator::make($input_request, [
      'Pertanyaan'      => 'required',
      'Jawaban'         => 'required|string',
      'StatusAktivasi'  => 'required|string|max:5',
      'TypePertanyaan'  => 'required|string|max:2',
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

    $result = $this->faqService->update($request->all());

    return $result;
  }

  public function hapus(FaqService $faqService, Request $request)
  {
    $Id     = $request['id'];
    $result = $this->faqService->destroy($Id);

    return response()->json($result);
  }
}
