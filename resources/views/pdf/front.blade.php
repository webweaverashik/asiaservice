<div class="col-3 px-4" style="padding-top: 4px; padding-bottom: 4px;">
    <div class="row text-left">
      <div class="col-12">SL. {{ $pinBatches[$loop-1]['serial_no'] }}</div>
    </div>
    <div class="row bg-black rounded-top">
      <div class="col-6">PIN</div>
      <div class="col-6">PASS</div>
    </div>
    <div class="row border border-dark rounded-bottom text-body" style="font-family: 'Monaco', monospace;">
      <div class="col-6">{{ $pinBatches[$loop-1]['pin'] }}</div>
      <div class="col-6">{{ $pinBatches[$loop-1]['pass'] }}</div>
    </div>
    <div class="row pt-1 text-left">
      <div class="col-12">{{ $pinBatches[$loop-1]['pb_reference'] }}</div>
    </div>
</div>