@extends('layouts.app')
@section('title', 'Pinbatch Upload')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper custom-font">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Pin Batch Print</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Print</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Main row -->
          <div class="row">
            <div class="col-md-8">
              <!-- general form elements -->
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Generate Card Print</h3>
                </div>
                <!-- /.card-header -->
  
                <!-- form start -->
                <form action="{{ url('upload') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="pb_reference">Reference No.</label>
                      <input type="text" class="form-control" id="pb_reference" name="pb_reference" placeholder="Enter any reference no." required>
                    </div>
                    <div class="form-group">
                      <label for="csv_file">CSV File Upload</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="csv_file" name="csv_file" accept=".csv" required>
                          <label class="custom-file-label" for="csv_file">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <div class="row">
                      <div class="col-md-12 d-flex justify-content-between">
                      <button type="submit" class="btn btn-outline-info" name="btn_pdf_gen" id="btn_pdf_gen">Generate PDF</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.card -->
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
  document.getElementById("pinbatch_menu").className += " active";
</script>
@endsection
