<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Print | AsiaStar</title>

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,700;1,400&display=swap">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Content Wrapper contains whole page content-->
    <div class="wrapper">

        <div class="container-fluid text-center" id="print_element" style="font-size: 14px;">
            <div class="row align-items-center align-middle" style="padding: 10px 0;">
                @foreach ($pinBatches as $batch)
                    <div class="col-3 px-4" style="padding-top: 4px; padding-bottom: 4px;">
                        <div class="row text-left">
                            <div class="col-12">SL. {{ $batch['serial_no'] }}</div>
                        </div>
                        <div class="row bg-black rounded-top">
                            <div class="col-6">PIN</div>
                            <div class="col-6">PASS</div>
                        </div>
                        <div class="row border border-dark rounded-bottom text-secondary" style="font-family: 'Monaco', monospace;">
                            <div class="col-6">{{ $batch['pin'] }}</div>
                            <div class="col-6">{{ $batch['pass'] }}</div>
                        </div>
                        <div class="row pt-1 text-left">
                            <div class="col-12">{{ $batch['pb_reference'] }}</div>
                        </div>
                    </div>
                @endforeach
                <div class='col-md-12'></div>
                <div class="html2pdf__page-break"></div>
                <div class='col-md-12' style='padding: 4px 0;'></div>

                @foreach ($pinBatches as $batch)
                    <div class="col-3 position-relative" style="margin-top: 10px; margin-bottom: 8px;">
                        <img src="{{ $rearImageUrl }}" class="" style="width: 170px; height: 80px;">
                        <div class="position-absolute text-white"
                            style="font-size: 13px; font-weight: 700; bottom: 10px; right: 18px;">
                            ${{ $batch['balance'] }}
                        </div>
                    </div>
                @endforeach

                <div class='col-md-12'></div>
                <div class="html2pdf__page-break"></div>

            </div>
        </div>
        <!-- end of row -->
    </div>
    <!-- end of container-fluid -->
    </div>
    <!-- ./wrapper -->


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/html2pdf.js/html2pdf.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var print_element = document.getElementById('print_element');
            // var print_element = $('#print_element')[0];

            var opt = {
                margin: [0.2, 0.15, 0.13, 0.3], // [top, left, bottom, right]
                // margin: 0.2,
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                filename: 'PDF_file.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scrollY: 0,
                    scrollX: 0,
                    dpi: 600,
                    scale: 3,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };

            // New Promise-based usage:
            // html2pdf().set(opt).from(print_element).save();


            // // redirect to homepage after 5 seconds
            // window.setTimeout(function () {
            //     window.location.href = 'index.php';
            // }, 5000);

        });
    </script>
</body>

</html>