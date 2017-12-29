<header class="topbar">
  <div class="topbar-left">
    <span class="topbar-btn sidebar-toggler"><i>&#9776;</i></span>
  </div>

  <div class="topbar-right">
    <ul class="topbar-btns">
      {{-- user --}}
      <li class="dropdown">
        <span class="topbar-btn" data-toggle="dropdown"><img class="avatar" src="/img/avatar/1.jpg" alt="..."></span>
        <div class="dropdown-menu dropdown-menu-right">
          <a class="dropdown-item" href="#"><i class="ti-lock"></i> Lock</a>
          <a class="dropdown-item" href="#"
          onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
          <i class="ti-power-off"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('admin.logout.submit') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        </div>
      </li>
      {{-- end user --}}
    </ul>

  </div>
</header>
