<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('admin.dashboard')}}">
        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('cities.index')}}">
        <span class="icon-bg"><i class="mdi mdi-city menu-icon"></i></span>
        <span class="menu-title">Cities</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('types.index')}}">
        <span class="icon-bg"><i class="mdi mdi-shape menu-icon"></i></span>
        <span class="menu-title">Types</span>
      </a>
    </li>


    <li class="nav-item">

      <a class="nav-link"  data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="icon-bg"><i class="mdi mdi-source-repository menu-icon"></i></span>
        <span class="menu-title">Repositories</span>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
        
        <li class="nav-item"> <a class="nav-link" href="{{route('repositories.index')}}"> Repositories </a></li>

          <li class="nav-item"> <a class="nav-link" href="{{route('admin.not_verified')}}"> Pending </a></li>

        </ul>
      </div>
    </li>


    <li class="nav-item">
      <a class="nav-link" href="{{route('employees.index')}}">
        <span class="icon-bg"><i class=" mdi mdi-account menu-icon"></i></span>
        <span class="menu-title">Employees</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('admin.contacts.index')}}">
        <span class="icon-bg"><i class=" mdi mdi-account menu-icon"></i></span>
        <span class="menu-title">Contacts</span>
      </a>
    </li>
    <li class="nav-item sidebar-user-actions">
      <div class="user-details">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <div class="d-flex align-items-center">
              <div class="sidebar-profile-img">
                <img src="{{ url('dashboard/assets/images/faces/face28.png')}}" alt="image">
              </div>
              <div class="sidebar-profile-text">
                <p class="mb-1">{{Auth::user()->name}}</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </li>
    <li class="nav-item sidebar-user-actions">
      <div class="sidebar-user-menu">
        <!-- <a href="#" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                    <span class="menu-title">Log Out</span></a> -->

        <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
          @csrf
          <button type="submit" class="nav-link" style="background: none; border: none; padding: 0;">
            <i class="mdi mdi-logout menu-icon"></i>
            <span class="menu-title">Log Out</span></button>
        </form>
      </div>
    </li>
  </ul>
</nav>