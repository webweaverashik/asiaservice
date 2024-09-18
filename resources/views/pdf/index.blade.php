@include('pdf.header')

    <div class="container-fluid text-center"  style="font-size: 14px;">
        <div class="row align-items-center align-middle" style="padding: 10px 0;">

            @php
                $img_loop = 0;
                $totalBatches = count($pinBatches);
            @endphp
                

            @for($loop = 1; $loop <= $totalBatches; $loop++)
                @include('pdf.front')
                
                {{-- Checking for 44 rounds of pin printing loop --}}
                @if ($loop % 44 == 0)
                    @php
                        $img_loop++;
                    @endphp
                    
                    <div class='col-md-12'></div>
                    <div class="html2pdf__page-break"></div>
                    <div class='col-md-12' style='padding: 5px 0 5px 0;'></div>

                    @for ($j=1; $j <= 44 ; $j++)
                        @include('pdf.rear') {{-- printing rear page --}}
                    @endfor

                    <div class='col-md-12'></div>
                    <div class="html2pdf__page-break"></div>
                    <div class='col-md-12' style='padding: 8px 0 0;'></div>
                @endif

            @endfor

            {{-- remaining image print --}}
            @php $left_loop = $loop - ($img_loop*44); @endphp
            
            @if ($left_loop != 0)  
                <div class='col-md-12'></div>
                <div class="html2pdf__page-break"></div>
                <div class='col-md-12' style='padding: 8px 0 0 0;'></div>

                @for ($j=1; $j < $left_loop ; $j++)
                    @include('pdf.rear') {{-- printing back page --}}
                @endfor
            @endif

        </div>

    @include('pdf.script')

@include('pdf.footer')