<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle me-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- App Name -->
  <a class="navbar-brand text-primary font-weight-bold" href="{{ route('home') }}" style="font-size: 1.5rem;">
    <i class="fas fa-school"></i> {{ config('app.name', 'Laravel') }}
  </a>

  <!-- User Info -->
  <ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <!-- User Icon -->
        <i class="fas fa-user-circle me-2 text-gray-600"></i>
        <span class="me-2 d-none d-lg-inline text-gray-600 small">
          {{ $user->family_name }} {{ $user->given_name }}
        </span>
      </a>
      <!-- Dropdown Menu -->
      <ul class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
        <li>
          <a class="dropdown-item" href="{{ route('students.show', ['id' => $user->id]) }}">
            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
            プロフィール
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
            ログアウト
          </a>
        </li>
      </ul>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
</nav>