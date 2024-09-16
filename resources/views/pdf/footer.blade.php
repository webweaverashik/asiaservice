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
                    margin: [0.1, 0, 0.1, 0.15], // [top, left, bottom, right]
                    pagebreak: {
                        mode: ['avoid-all', 'css', 'legacy']
                    },
                    filename: '{{ $reference }}.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.85
                    },
                    html2canvas: {
                        scrollY: 0,
                        scrollX: 0,
                        dpi: 600,
                        scale: 2.5,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'a4',
                        orientation: 'portrait'
                    }
                };
        
                // Add a delay to ensure assets are loaded
                setTimeout(function () {
                    html2pdf().set(opt).from(print_element).save();
        
                    // redirect to homepage after 5 seconds
                    window.setTimeout(function () {
                        window.location.href = '{{ route('dashboard') }}';
                    }, 5000);
                }, 2000); // Adjust the delay time as needed
        
            });
        </script>
        

    </body>
</html>