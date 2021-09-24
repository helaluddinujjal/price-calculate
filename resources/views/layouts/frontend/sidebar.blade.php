<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{url('home')}}" class="brand-link">
    {{-- <img src="{{asset('images/admin/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
    <span class="brand-text font-weight-light text-center">Bloom Cheker</span>
  </a>

    <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">

        {{-- @if (!empty(Auth::guard('admin')->user()->image))
          <img src="{{asset('images/admin/profile/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">        
        @else
          <img src="{{asset('images/admin/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">              
        @endif --}}
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->

    {{-- dashboard --}}
    @php
        if (Session::get('page')=='home') {
          $active='active';
        } else {
          $active='';
        }
    @endphp
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
        <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('/home')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        {{-- settings --}}
       
        <li class="nav-item has-treeview {{$active}}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          @php
            if (Session::get('page')=='account-settings') {
              $active='active';
            } else {
              $active='';
            }
          @endphp
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('/account-settings')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile Settings</p>
              </a>
            </li>
          </ul>
        </li>
        

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
    <!-- /.sidebar -->
</aside>