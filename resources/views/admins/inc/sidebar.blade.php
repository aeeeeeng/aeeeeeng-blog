<aside class="sidebar sidebar-icons-right sidebar-icons-boxed sidebar-expand-lg">
  <header class="sidebar-header">
    <a class="logo-icon" href="index.html"><img src="/img/logo-icon-light.png" alt="logo icon"></a>
    <span class="logo">
      <a href="index.html"><img src="/img/logo-light.png" alt="logo"></a>
    </span>
    <span class="sidebar-toggle-fold"></span>
  </header>

  <nav class="sidebar-navigation">
    <ul class="menu">

      <li class="menu-category">Category 1</li>

      <li class="menu-item {{active("admin03061993/dashboard")}}">
        <a class="menu-link" href="/admin03061993/dashboard">
          <span class="icon fa fa-home"></span>
          <span class="title">Dashboard</span>
        </a>
      </li>

      <li class="menu-item {{active(["admin03061993/admin", "admin03061993/admin/*", "admin03061993/category", "admin03061993/category/*", "admin03061993/tag", "admin03061993/tag/*"], 'active open')}}">
        <a class="menu-link" href="#">
          <span class="icon fa fa-folder-open"></span>
          <span class="title">Data Master</span>
          <span class="arrow"></span>
        </a>

        <ul class="menu-submenu">
          <li class="menu-item {{active(["admin03061993/admin", "admin03061993/admin/*", ])}}">
            <a class="menu-link" href="/admin03061993/admin">
              <span class="dot"></span>
              <span class="title">Admins</span>
            </a>
          </li>
          <li class="menu-item {{active(["admin03061993/category", "admin03061993/category/*"])}}">
            <a class="menu-link" href="/admin03061993/category">
              <span class="dot"></span>
              <span class="title">Category</span>
            </a>
          </li>
          <li class="menu-item {{active(["admin03061993/tag", "admin03061993/tag/*"])}}">
            <a class="menu-link" href="/admin03061993/tag">
              <span class="dot"></span>
              <span class="title">Tags</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{active(["admin03061993/blog", "admin03061993/blog/*"], 'active open')}}">
        <a class="menu-link" href="#">
          <span class="icon fa fa-pencil-square-o"></span>
          <span class="title">Blog</span>
          <span class="arrow"></span>
        </a>

        <ul class="menu-submenu">
          <li class="menu-item {{active(["admin03061993/blog", "admin03061993/blog/*", ])}}">
            <a class="menu-link" href="/admin03061993/blog">
              <span class="dot"></span>
              <span class="title">Post</span>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>

</aside>
