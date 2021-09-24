        <nav class="navbar container  navbar-expand-lg navbar-white navbar-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{'/home'}}">Bloom Chacker</a>
      
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
          <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            @php
            if (Session::get('page')=='home') {
              $active='active';
            } else {
              $active='';
            }
        @endphp
            <li class="nav-item {{$active}}">
              <a class="nav-link" href="{{url('/home')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            @php
            if (Session::get('page')=='account-settings') {
              $active='active';
            } else {
              $active='';
            }
        @endphp
            <li class="nav-item">
              <a class="nav-link {{$active}}" href="{{url('/account-settings')}}">Profile Settings</a>
            </li>
          </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{url('/logout')}}" role="button">
              <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          </li>
        </ul>
        </div>
      </nav>
