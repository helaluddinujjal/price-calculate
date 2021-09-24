<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{url('admin/dashboard')}}" class="brand-link">
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
        <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->

    {{-- dashboard --}}
    @php
        if (Session::get('page')=='dashboard') {
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
          <a href="{{url('admin/dashboard')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        {{-- settings --}}
        @php
          if (Session::get('page')=='admin-account-settings' ||Session::get('page')=='admin-site-settings') {
            $active='menu-is-opening menu-open';
          } else {
            $active='';
          }
        @endphp
        <li class="nav-item has-treeview {{$active}}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cogs"></i>
            <p>
              Settings
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          @php
            if (Session::get('page')=='admin-account-settings') {
              $active='active';
            } else {
              $active='';
            }
          @endphp
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{url('admin/account-settings')}}" class="nav-link {{$active}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Profile Settings</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- Season Menu -->
        @php
        if (Session::get('page')=='admin-seasons') {
          $active='active';
        } else {
          $active='';
        }
        @endphp
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('admin/seasons')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-wind"></i>
            <p>
              Seasons
            </p>
          </a>
        </li>
        <!-- Type Menu -->
        @php
        if (Session::get('page')=='admin-types') {
          $active='active';
        } else {
          $active='';
        }
        @endphp
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('admin/types')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-border-style"></i>
            <p>
              Types
            </p>
          </a>
        </li>
        <!-- flower types Menu -->
        @php
        if (Session::get('page')=='admin-flower-categories') {
          $active='active';
        } else {
          $active='';
        }
        @endphp
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="{{url('admin/categories')}}" class="nav-link {{$active}}">
            <i class="nav-icon fas fa-fan"></i>
            <p>
              Flower Types
            </p>
          </a>
        </li>
        {{-- companies --}}
        @php
        if (Session::get('page')=='admin-companies' ||Session::get('page')=='admin-price') {
          $active='menu-is-opening menu-open';
        } else {
          $active='';
        }
      @endphp
      <li class="nav-item has-treeview {{$active}}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Company
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        @php
          if (Session::get('page')=='admin-companies') {
            $active='active';
          } else {
            $active='';
          }
        @endphp
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{url('admin/companies')}}" class="nav-link {{$active}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Company List</p>
            </a>
          </li>
          {{-- admin price --}}
          @php  
          if (Session::get('page')=='admin-price') {
              $active='active';
            } else {
              $active='';
            }
        @endphp
        <li class="nav-item">
          <a href="{{url('admin/price')}}" class="nav-link {{$active}}">
            <i class="far fa-circle nav-icon"></i>
            <p>Add Price </p>
          </a>
        </li>
        </ul>
      </li>
                <!-- Price calculate Menu -->
                @php
                if (Session::get('page')=='admin-price-calculate') {
                  $active='active';
                } else {
                  $active='';
                }
                @endphp
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{url('admin/price-calculate')}}" class="nav-link {{$active}}">
                    <i class="nav-icon fas fa-calculator"></i>
                    <p>
                      Price Calculate
                    </p>
                  </a>
                </li>
                <!--Admins Menu -->
                @php
                if (Session::get('page')=='admin-list') {
                  $active='active';
                } else {
                  $active='';
                }
                @endphp
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{url('admin/admins')}}" class="nav-link {{$active}}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                      Admins
                    </p>
                  </a>
                </li>
                <!--Users Menu -->
                @php
                if (Session::get('page')=='user-list') {
                  $active='active';
                } else {
                  $active='';
                }
                @endphp
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                  <a href="{{url('admin/users')}}" class="nav-link {{$active}}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                      Users
                    </p>
                  </a>
                </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
    <!-- /.sidebar -->
</aside>