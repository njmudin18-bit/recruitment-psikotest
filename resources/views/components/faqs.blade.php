<div>
  <section class="section mt-5" id="faqs">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="text-center mb-5">
            <div class="small-title text-black fw-bold">Pertanyaan?</div>
            <h4 class="text-black">Pertanyaan yang sering diajukan</h4>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="vertical-nav">
            <div class="row">
              <div class="col-lg-2 col-sm-4">
                <div class="nav flex-column nav-pills" role="tablist">
                  <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques" role="tab">
                    <i class="bx bx-help-circle nav-icon d-block mb-2"></i>
                    <p class="fw-bold text-black mb-0">Pertanyaan Umum</p>
                  </a>
                  <a class="nav-link" id="v-pills-token-sale-tab" data-bs-toggle="pill" href="#v-pills-token-sale" role="tab"> 
                    <i class="bx bx-check-shield nav-icon d-block mb-2"></i>
                    <p class="fw-bold text-black mb-0">Privasi Data</p>
                  </a>
                </div>
              </div>
              <div class="col-lg-10 col-sm-8">
                <div class="card">
                  <div class="card-body">
                    <div class="tab-content">
                      <div class="tab-pane fade show active" id="v-pills-gen-ques" role="tabpanel">
                        <h4 class="card-title text-black mb-4">Pertanyaan Umum</h4>
                        <div>
                          <div id="gen-ques-accordion" class="accordion custom-accordion">
                            @foreach ($pertanyaanUmum as $key => $pertanyaan)
                              @php $key = $key + 1 @endphp
                              <div class="mb-3">
                                <a href="#token-collapse{{ $key }}" class="accordion-list {{ $key > '1' ? 'collapsed' : '' }}" data-bs-toggle="collapse"
                                  aria-expanded="false" aria-controls="token-collapse{{ $key }}">
                                  <div class="text-black">{{ $pertanyaan->Pertanyaan }}</div>
                                  <i class="mdi mdi-minus accor-plus-icon"></i>
                                </a>
                                <div id="token-collapse{{ $key }}" class="collapse {{ $key == '1' ? 'show' : '' }}" data-bs-parent="#token-accordion{{ $key }}">
                                  <div class="card-body">
                                    <p class="mb-0">{!! $pertanyaan->Jawaban !!}</p>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>

                      <div class="tab-pane fade" id="v-pills-token-sale" role="tabpanel">
                        <h4 class="card-title text-black mb-4">Privasi Data</h4> 
                        <div>
                          <div id="token-accordion" class="accordion custom-accordion">
                            @foreach ($privasiData as $key => $privasi)
                              @php $key = $key + 1 @endphp
                              <div class="mb-3">
                                <a href="#token-collapse{{ $key }}" class="accordion-list {{ $key > '1' ? 'collapsed' : '' }}" data-bs-toggle="collapse"
                                  aria-expanded="false" aria-controls="token-collapse{{ $key }}">
                                  <div class="text-black">{{ $privasi->Pertanyaan }}</div>
                                  <i class="mdi mdi-minus accor-plus-icon"></i>
                                </a>
                                <div id="token-collapse{{ $key }}" class="collapse {{ $key == '1' ? 'show' : '' }}" data-bs-parent="#token-accordion{{ $key }}">
                                  <div class="card-body">
                                    <p class="mb-0">{!! $privasi->Jawaban !!}</p>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>