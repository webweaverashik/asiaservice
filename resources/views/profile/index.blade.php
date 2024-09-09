@extends('layouts.app')
@section('title', 'My Profile')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper custom-font">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Your Profile</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
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
                    <div class="col-xl-6">
                        <form action="{{ url('profile/edit') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Password Reset</h3>
                                </div>
                                <div class="card-body">
                                    <div class="input-group mb-3">
                                        <label class="col-sm-3 col-form-label">Username</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" value="{{ $profile->email }}" disabled readonly>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input name="newPassword" id="newPassword" type="password" class="form-control" placeholder="Enter New Password" required autocomplete="new-password">

                                        <div class="input-group-append">
                                            <div class="input-group-text bg-white">
                                                <i class="fas fa-eye" id="toggleNewPassword" style="cursor: pointer;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group mb-3">
                                        <label for="newPassword" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                                        </div>
                                        <input name="confirmPassword" id="confirmPassword" type="password" class="form-control" placeholder="Confirm New Password" required autocomplete="confirm-password">

                                        <div class="input-group-append">
                                            <div class="input-group-text bg-white">
                                                <i class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-info" name="btnProfileUpdate"
                                        id="btnProfileUpdate">Update</button>
                                </div>
                            </div>
                        </form>
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
    document.getElementById("profile_menu").className += " active";
</script>

<!-- Password View -->
<script>
    $(function(){
        $('#toggleNewPassword').click(function() {
            if($(this).hasClass('fa-eye')) {
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $('#newPassword').attr('type','text');
            } else{
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $('#newPassword').attr('type','password');
            }
        });

        $('#toggleConfirmPassword').click(function() {
            if($(this).hasClass('fa-eye')) {
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $('#confirmPassword').attr('type','text');
            } else{
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $('#confirmPassword').attr('type','password');
            }
        });
    });



    $('#btnProfileUpdate').on('click', function(e) {
        // Prevent the form from submitting
        e.preventDefault();

        // Get the values of the password fields
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();

        // Simplified regular expression for minimum length only
        var lengthRegex = /^.{8,}$/;

        // Check if passwords match
        if (newPassword !== confirmPassword) {
            alert('Both passwords should match.');
            return false;
        }

        // Check if new password meets minimum length requirement
        if (!lengthRegex.test(newPassword)) {
            alert('Password must be at least 8 characters long.');
            return false;
        }

        // If all checks pass, submit the form
        $(this).closest('form').submit();
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