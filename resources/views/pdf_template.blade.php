<!DOCTYPE html>
<html>
<head>
    <style>
        .pin-batch {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            page-break-after: always;
        }
        .pin-card {
            border: 1px solid #000;
            width: 45%;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
        .serial {
            font-size: 12px;
            font-weight: bold;
        }
        .pin-pass {
            font-size: 14px;
            font-weight: bold;
        }
        .balance {
            font-size: 18px;
            color: #000;
        }
    </style>
</head>
<body>

    <!-- First page with 48 PIN batches -->
    <div class="pin-batch">
        @foreach ($pinBatches as $batch)
        <div class="pin-card">
            <div class="serial">SL. {{ $batch['serial_no'] }}</div>
            <div class="pin-pass">PIN: {{ $batch['pin'] }} PASS: {{ $batch['pass'] }}</div>
            <div class="balance">$ {{ $batch['balance'] }}</div>
        </div>
        @endforeach
    </div>

    <!-- Reverse page with image and balance -->
    <div class="reverse-image" style="page-break-before: always;">
        <img src="{{ $rearImageUrl }}" style="width: 100%;">
    </div>

</body>
</html>
