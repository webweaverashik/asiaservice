  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4 layout-fixed">
    <!-- Brand Logo -->
    <a href="{{ url('dashboard') }}" class="brand-link">
      <img src="{{ asset('assets/img/logo.png') }}" alt="AsiaStar" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light font-weight-bold">Asia Star</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
        <div class="image">
          <img src="{{ asset('assets/img/profile-photo.png') }}" class="img-circle elevation-2" alt="Profile photo">
        </div>
        <div class="info">
            <span class="text-white d-block">Hello, <i>{{ session('name') }}</i></span>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2 ">
        <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

          <li class="nav-item">            
            <a href="{{ url('dashboard') }}" class="nav-link" id="dashboard_menu">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">            
            <a href="{{ url('upload') }}" class="nav-link" id="pinbatch_menu">
              <i class="nav-icon fas fa-file-csv"></i>
              <p>
                Pinbatch Print
              </p>
            </a>
          </li>

          <li class="nav-item">            
            <a href="{{ url('profile') }}" class="nav-link" id="profile_menu">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                User Profile
              </p>
            </a>
          </li>


          <li class="nav-item">            
            <a href="{{ url('activity') }}" class="nav-link" id="activity_menu">
              <i class="nav-icon fas fa-skull-crossbones"></i>
              <p>
                Login Activity
              </p>
            </a>
          </li>

<!-- Admin Role PHP Ends -->



          <li class="nav-item bg-danger rounded position-fixed" style="bottom: 20px">
            <a href="{{ url('logout') }}">
              <button type="submit" class="nav-link btn-danger text-white text-left" name="btnLogout"><i class="nav-icon fas fa-sign-out-alt"></i><p>Log Out</p></button>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
