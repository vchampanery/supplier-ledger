<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="/" class="brand-link">
    <span class="brand-text font-weight-light">Morima</span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
        <li class="nav-item">
          <a href="{{ url('/') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/suppliers') }}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Suppliers</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/city') }}" class="nav-link">
            <i class="nav-icon fas fa-city"></i>
            <p>City</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/bills') }}" class="nav-link">
            <i class="nav-icon fas fa-receipt"></i>
            <p>Bills</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
