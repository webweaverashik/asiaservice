<div class="col-3 position-relative" style="margin-top: 8px; margin-bottom: 8px;" >
    <img src="{{ asset('uploads/img/rear-image.jpg') }}" class="" style="width: 175px; height: 82px;">
    @php
        $balance = $pinBatches[1]['balance'];
        $isFloat = is_float($balance) || (floor($balance) != $balance);
        $rightValue = $balance < 10 ? '19px' : '16px';
        $fontSize = $isFloat ? '8px' : '14px';
    @endphp

    <div class="position-absolute text-white" style="font-size: {{ $fontSize }}; font-weight: 700; bottom: 10px; right: {{ $rightValue }};">
        {{ '$' . $balance }}
    </div>

</div>