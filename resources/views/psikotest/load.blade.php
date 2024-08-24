<div id="load" style="position: relative;">
  @foreach($Type as $item)
    <div class="container">
      <form id="formUjian" action="" method="post">
        <div class="row">
          @foreach ($Type as $key => $value)
          <div class="col-md-12">
            <h5 class="mb-3 mt-2 fw-bold">{{ $value->Urutan }}. {{ $value->Nama }}</h5>
            <h6 class="mb-3 mt-1">{!! $value->ContohSoal !!}</h6>
            @php
              $Data = \App\Models\SoalModel::where('Status', 'AKTIF')->where('IdTypeUjian', $value->Id)->get();
            @endphp

            @if($Data->isEmpty())
              <p>No active records found.</p>
            @else
              <input type="hidden" name="JumlahSoal" value="{{ count($Data) }}">
              @foreach($Data as $key => $item)
                <div class="row">
                  <div class="col-md-12 col-sm-12 mt-2 mb-1 fw-bold">
                    <div class="row">
                      @if($item->PosisiGambar == 'Atas')
                        @if($item->Gambar != null)
                          <div class="col-md-12">
                            <img class="rounded img-fluid me-2 mb-3 mt-3" width="400" src="{{ asset($item->Gambar) }}" data-holder-rendered="true">
                          </div>
                        @endif
                      @endif
                      <div class="col-md-12" style="display: flex;">
                        <p>{{ $key+1 }}.&nbsp;{!! ucfirst($item->Soal) !!}</p>
                        <input type="hidden" name="IdSoal[]" value="{{ $item->Id }}">
                      </div>
                      @if($item->PosisiGambar == 'Bawah')
                        @if($item->Gambar != null)
                          <div class="col-md-12">
                            <img class="rounded img-fluid me-2 mb-3 mt-3" width="400" src="{{ asset($item->Gambar) }}" data-holder-rendered="true">
                          </div>
                        @endif
                      @endif
                    </div>
                  </div>
                  @if($item->A != '' || $item->A != null)
                  <div class="col-md-4 col-sm-12 mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="A">
                      <label class="form-check-label" for="formRadios1">A. {{ $item->A }}</label>
                    </div>
                  </div>
                  @endif
                  @if($item->B != '' || $item->B != null)
                  <div class="col-md-4 col-sm-12 mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="B">
                      <label class="form-check-label" for="formRadios1">B. {{ $item->B }}</label>
                    </div>
                  </div>
                  @endif
                  @if($item->C != '' || $item->C != null)
                  <div class="col-md-4 col-sm-12 mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="C">
                      <label class="form-check-label" for="formRadios1">C. {{ $item->C }}</label>
                    </div>
                  </div>
                  @endif
                  @if($item->D != '' || $item->D != null)
                  <div class="col-md-4 col-sm-12 mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="D">
                      <label class="form-check-label" for="formRadios1">D. {{ $item->D }}</label>
                    </div>
                  </div>
                  @endif
                  @if($item->E != '' || $item->E != null)
                  <div class="col-md-4 col-sm-12 mb-3">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="Pilihan[{{ $item->Id }}]" value="E">
                      <label class="form-check-label" for="formRadios1">E. {{ $item->E }}</label>
                    </div>
                  </div>
                  @endif
                </div>
              @endforeach
            @endif
            <hr>
          </div>
          @endforeach
        </div>
      </form>
    </div>
  @endforeach
</div>
