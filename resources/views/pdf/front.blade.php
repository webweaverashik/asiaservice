<div class="col-3 px-4" style="padding-top: 4px; padding-bottom: 4px;">
    <div class="row text-left">
      <div class="col-12">SL. {{ $pinBatches[$loop]['serial_no'] }}</div>
    </div>
    <div class="row bg-black rounded-top">
      <div class="col-6">PIN</div>
      <div class="col-6">PASS</div>
    </div>
    <div class="row border border-dark rounded-bottom text-secondary" style="font-family: 'Monaco', monospace;">
      <div class="col-6">{{ $pinBatches[$loop]['pin'] }}</div>
      <div class="col-6">{{ $pinBatches[$loop]['pass'] }}</div>
    </div>
    <div class="row pt-1 text-left">
      <div class="col-12">{{ $pinBatches[$loop]['pb_reference'] }}</div>
    </div>
  </div>