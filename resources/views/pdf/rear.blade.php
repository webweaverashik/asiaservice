<div class="col-3 position-relative" style="margin-top: 10px; margin-bottom: 8px;" >
    <img src="{{ asset('uploads/img/rear-image.jpg') }}" class="" style="width: 170px; height: 80px;">
    <div class="position-absolute text-white" style="font-size: 13px; font-weight: 700; bottom: 10px; right: @if ($pinBatches[1]['balance'] < 10) 18px @else 16px @endif ;">
      {{ '$' . $pinBatches[1]['balance'] }}
      {{-- printing balance value --}}
    </div>
</div>