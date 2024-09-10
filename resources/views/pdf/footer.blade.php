                </div>
                <!-- end of row -->
            </div>
            <!-- end of container-fluid -->
        </div>
        <!-- ./wrapper -->

    <script src="{{ asset('plugins/html2pdf.js/html2pdf.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            var print_element = document.getElementById('print_element');

            var opt = {
                margin: [0.2, 0.15, 0.13, 0.3], // [top, left, bottom, right]
                // margin: 0.2,
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                filename: '{{ json_encode($reference) }}.pdf',
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

            console.log(filename);

            // New Promise-based usage:
            html2pdf().set(opt).from(print_element).save();


            // redirect to homepage after 5 seconds
            // window.setTimeout(function () {
            //     window.location.href = 'dashboard';
            // }, 5000);

        });
    </script>

    </body>
</html>