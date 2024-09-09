@extends('layouts.app')
@section('title', 'Dashboard')


@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper custom-font">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Report</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content custom-font">
        <!-- Main row -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title custom-font">Pinbatch upload and print history:</h3>
                </div>

                <div class="input-group d-flex justify-content-center mt-3">
                  <input type="text" class="text-center" placeholder="Starting Date" id="min" readonly>
                  <span id="min"></span>
                  <div class="input-group-prepend input-group-append">
                    <span class="input-group-text">To</span>
                  </div>
                  <input type="text" class="text-center" placeholder="Ending Date" id="max" readonly>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                  <table id="printHistoryTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>SL.</th>
                        <th>Reference</th>
                        <th>File Name</th>
                        <th class="d-none">File URL</th>
                        <th>Total Pin</th>
                        <th>Balance ($)</th>
                        <th>Upload Time</th>
                        <th class="d-none">Time Filter</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($results as $report)

                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $report->reference_key }}</td>
                      <td>{{ $report->csv_name }}</td>
                      <td class="d-none">{{ $report->file_url }}</td>
                      <td>{{ $report->pin_count }}</td>
                      <td>{{ $report->balance }}</td>
                      <td>{{ \Carbon\Carbon::parse($report->created_at)->format('d-m-Y H:i:s') }}</td>
                      <td class="d-none">{{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d') }}</td>
                      <td>
                          <form action="pdf-gen.php" method="post">
                            <input type="hidden" value="{{ $report['id'] }}" name="fileID"  class="d-none" readonly>
                            <input type="hidden" value="{{ $report['file_url'] }}" name="fileURL"  class="d-none" readonly>
                            <button type="submit" class="btn btn-outline-danger" name="btn_pdf_download" id="btn_pdf_download" title="Download .pdf">
                              <i class="fas fa-file-pdf"></i>
                            </button>

                            <button type="submit" class="btn btn-outline-warning" title="Remove .csv file" name="csv_remover" id="csv_remover">
                              <i class="fas fa-trash-alt"></i>
                            </button>
                          </form>
                      </td>
                    </tr>

                    @endforeach

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>SL</th>
                        <th>Reference</th>
                        <th>File Name</th>
                        <th class="d-none">File URL</th>
                        <th>Total Pin</th>
                        <th>Balance ($)</th>
                        <th>Upload Time</th>
                        <th class="d-none">Time Filter</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
        <!-- (main row) -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection


@section('custom-script')

<script>
  document.getElementById("dashboard_menu").className += " active";
</script>


  <!-- Table Generation Script -->
  <script>
    var minDate, maxDate;
  
    // Custom filtering function which will search data in column four between two values
    $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            let min = moment($('#min').val()).isValid() ?
                new Date( $('#min').val() ).setUTCHours(0,0,0,0) :
                null;
            
            let max = moment($('#max').val()).isValid() ?
                new Date( $('#max').val() ).setUTCHours(23,59,59,999):
                null;
            var date = new Date( data[7] );

            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max )  ||
                ( min <= date  && max === null ) ||
                ( min <= date  && date <= max )
            ) {
                return true;
            }
            return false;
        }
    );

    $(document).ready(function() {
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'yyyy-MM-DD'
        });
        maxDate = new DateTime($('#max'), {
            format: 'yyyy-MM-DD'
        });
    
        // DataTables initialisation
        var table = $('#printHistoryTable').DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          // order: [6, 'desc'],
        });


        // Refilter the table
        $('#min, #max').on('change', function () {
            table.draw();
        });
    });

    
  </script>


@if($message = session('success'))
  <script>

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: 'success',
      title: '{{ $message }}'
    })
  </script>
@endif

@if($message = session('warning'))
  <script>

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    Toast.fire({
      icon: 'warning',
      title: '{{ $message }}'
    })
  </script>
@endif

@endsection
