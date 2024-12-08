<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  <!-- Sidebar Toggle (Topbar) -->
  <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
  </button>

  <!-- App Name -->
  <a class="navbar-brand text-primary font-weight-bold" href="{{ route('home') }}" style="font-size: 1.5rem;">
    <i class="fas fa-school"></i> {{ config('app.name', 'Laravel') }}
  </a>

  <!-- User Info -->
  @php
  $user =Auth::user();
  @endphp
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <!-- 人のアイコンを追加 -->
        <i class="fas fa-user-circle mr-2 text-gray-600"></i>
        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          {{ $user->family_name }} {{ $user->given_name }}
        </span>
      </a>
      <!-- ドロップダウンメニュー -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{ route('students.show',['id'=>$user->id]) }}">
          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
          プロフィール
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          ログアウト
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
      </div>
    </li>
  </ul>
</nav>