  <!-- Main Sidebar Container -->
  <aside class="main-sidebar">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('images/Vieva Logo pro.png') }}" alt="Vieva Logo" class="brand-image img-circle elevation-3">
      <span class="">Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="mt-3 pb-3 mb-3 d-flex">

      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('analytics') }}" class="nav-link nav-link-side">
              <i class="nav-icon far fa-image analytics-icon"></i>
              <p>
                Analytics
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('content') }}" class="nav-link nav-link-side">
              <i class="nav-icon fa fa-caret-right content-icon"></i>
              <p>
                Content
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('administration') }}" class="nav-link">
              <i class="nav-icon fa fa-cog"></i>
              <p>
                Administration
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('activation') }}" class="nav-link nav-link-side">
              <i class="nav-icon fas fa-unlock-alt activation-icon"></i>
              <p>
                Activation
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('coaching') }}" class="nav-link nav-link-side active">
              <i class="nav-icon fas  fa-edit coaching-icon"></i>
              <p>
                Coaching reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('notification') }}" class="nav-link nav-link-side">
              <i class="nav-icon fas fa-bell notification-icon"></i>
              <p>
                Notifications
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('challenge') }}" class="nav-link nav-link-side">
              <i class="nav-icon fas  fa-edit coaching-icon"></i>
              <p>
                Challenge
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('questions') }}" class="nav-link nav-link-side">
              <i class="nav-icon fas  fa-edit coaching-icon"></i>
              <p>
                Questions
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('quizes') }}" class="nav-link nav-link-side">
              <i class="nav-icon fas  fa-edit coaching-icon"></i>
              <p>
                Quizes
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
