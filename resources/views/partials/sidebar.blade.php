<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar Brand -->

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('home') }}">
      <i class="fas fa-house"></i>
      <span>ホーム</span>
    </a>
  </li>

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('tests.home') }}">
      <i class="fa-solid fa-pen-nib"></i>
      <span>学習・テスト</span>
    </a>
  </li>

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('schools.index') }}">
      <i class="fa-solid fa-school"></i>
      <span>学校の成績</span>
    </a>
  </li>

  <!--
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('home') }}">
      <i class="fas fa-chalkboard-teacher"></i>
      <span>面談スケジュール</span>
    </a>
  </li>
  --->

  <li class="nav-item active">
    <a class="nav-link" href="{{ route('students.show') }}">
      <i class="fas fa-user"></i>
      <span>プロフィール</span>
    </a>
  </li>
</ul>