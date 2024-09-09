@extends('layouts.app')
@section('title', 'Login Activity')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper custom-font">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">System Activity</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Activity</li>
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
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Login Activity</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="loginInfoTable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Username</th>
                                            <th>IP</th>
                                            <th>Attempt Time</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($activities as $loginInfo)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $loginInfo->user_name }}</td>
                                            <td>{{ $loginInfo->login_IP }}</td>
                                            {{-- <td>{{ $loginInfo['created_at'] }}</td> --}}
                                            <td>{{ \Carbon\Carbon::parse($loginInfo->created_at)->format('d-M-Y, h:i:s A') }}</td>
                                            <td>
                                                @if ($loginInfo->status == 'Success')
                                                    <span class="badge badge-success"> {{ $loginInfo->status }}</span>
                                                @else
                                                    <span class="badge badge-danger"> {{ $loginInfo->status }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


@section('custom-script')
<script>
    document.getElementById("activity_menu").className += " active";
</script>

<!-- DataTables -->
<script>
    var table = $('#loginInfoTable').DataTable({
    // "responsive": false, "lengthChange": true, "autoWidth": false,
    // order: [0, 'desc'],
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

@endsection'