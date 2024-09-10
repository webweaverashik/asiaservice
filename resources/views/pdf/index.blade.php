@include('layouts.header')

    <div class="container-fluid text-center" id="print_element" style="font-size: 14px;">
        <div class="row align-items-center align-middle" style="padding: 10px 0;">

            @for ($i = 0; $i <44; $i++)
                @include('pdf.front')
            @endfor

            <div class='col-md-12'></div>
            <div class="html2pdf__page-break"></div>
            <div class='col-md-12' style='padding: 5px 0 5px 0;'></div>

            @for ($i = 0; $i <44; $i++)
                @include('pdf.rear')
            @endfor

            <div class='col-md-12'></div>
            <div class="html2pdf__page-break"></div>
            <div class='col-md-12' style='padding: 8px 0 0;'></div>


            {{-- remaining image print --}}
            



        </div>

    @include('pdf.script')
    
@include('pdf.footer')