<div class="col-3 position-relative" style="margin-top: 10px; margin-bottom: 8px;" >
    <img src="{{ asset('uploads/img/rear-image.jpg') }}" class="" style="width: 170px; height: 80px;">
    @php
        $balance = $pinBatches[1]['balance'];
        $isFloat = is_float($balance) || (floor($balance) != $balance);
        $rightValue = $balance < 10 ? '20px' : '17px';
        $fontSize = $isFloat ? '9px' : '13px';
    @endphp

    <div class="position-absolute text-white" style="font-size: {{ $fontSize }}; font-weight: 700; bottom: 10px; right: {{ $rightValue }};">
        {{ '$' . $balance }}
    </div>

</div>