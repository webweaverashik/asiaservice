</div>
<!-- end of row -->
</div>
<!-- end of container-fluid -->
</div>
<!-- ./wrapper -->

<script src="plugins/html2pdf.js/html2pdf.bundle.min.js"></script>
<!-- <script src="includes/js/FileSaver.js"></script> -->
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
            filename: 'PDF_print.pdf',
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
        html2pdf().set(opt).from(print_element).save();


        // redirect to homepage after 5 seconds
        // window.setTimeout(function () {
        //     window.location.href = 'index.php';
        // }, 5000);

    });
</script>

</body>

</html>