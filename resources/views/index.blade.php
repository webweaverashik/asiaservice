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
                        <th>Total Pin</th>
                        <th>Balance ($)</th>
                        <th>Upload Time</th>
                        <th class="d-none">Date Filter</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>

                    @foreach ($results as $report)

                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $report->reference_key }}</td>
                      <td>{{ $report->csv_name }}</td>
                      <td>{{ $report->pin_count }}</td>
                      <td>{{ $report->balance }}</td>
                      <td>{{ \Carbon\Carbon::parse($report->created_at)->format('d-M-Y, h:i:s A') }}</td>
                      <td class="d-none">{{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d') }}</td>
                      <td>
                        @if ($report->is_deleted != 1) 
                          <form>
                            <a href="{{ $report->file_url }}" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Download CSV">
                              <i class="fas fa-file-csv text-lg"></i>
                            </a>
                            <a href="{{ url('file/' . $report->id . '/view') }}" class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Download PDF">
                              <i class="fas fa-file-pdf text-lg"></i>
                            </a>
                            <a href="{{ url('file/' . $report->id . '/delete') }}" class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirmDelete()">
                              <i class="fas fa-trash text-lg"></i>
                            </a>
                          </form>
                        @else 
                          <span class="text-muted">File Deleted</span>
                        @endif
                      </td>
                    </tr>

                    @endforeach

                    </tbody>
                    <tfoot>
                      <tr>
                        <th>SL.</th>
                        <th>Reference</th>
                        <th>File Name</th>
                        <th>Total Pin</th>
                        <th>Balance ($)</th>
                        <th>Upload Time</th>
                        <th class="d-none">Date Filter</th>
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

  function confirmDelete() {
    return confirm('Are you sure you want to delete this? Once deleted, it cannot be retrieved.');
  }
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
            var date = new Date( data[6] );

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
