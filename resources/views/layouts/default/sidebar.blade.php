<nav class="sidebar sidebar-offcanvas mt-2" id="sidebar">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{url('/dashboard')}}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">{{ __('Dashboard') }}</span>
              </a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    @if (auth()->user()->can('manage-users'))
                      <li class="nav-item"> <a class="nav-link" href="{{ route('user.list') }}"> Users List </a></li>
                    @endif
                    <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> User Roles </a></li>
                </ul>
              </div>
            </li>

            
            <li class="nav-item d-none">
              <a class="nav-link" data-bs-toggle="collapse" href="#carecell" aria-expanded="false" aria-controls="carecell">
                <i class="menu-icon mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">{{ __('Carecell') }}</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="carecell">
                <ul class="nav flex-column sub-menu">
                    @if (auth()->user()->can('manage-users'))
                        <li class="nav-item"> <a class="nav-link" href="{{ route('pastor.list') }}"> {{ __('Pastors List') }} </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('carecell_area.list') }}"> {{ __('Carecell Areas') }} </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('carecell_leader.list') }}"> {{ __('Carecell Leaders') }} </a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('carecell_meeting.list') }}"> {{ __('Carecell Meetings') }} </a></li>
                    @endif
                </ul>
              </div>
            </li>


            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#settings" aria-expanded="false" aria-controls="settings">
                <i class="menu-icon mdi mdi-account-circle-outline"></i>
                <span class="menu-title">Settings</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="settings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#"> General Settings </a></li>
                    <li class="nav-item"> <a class="nav-link" href="#"> Site Settings </a></li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
