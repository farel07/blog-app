<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/posts') || Request::is('dashboard/posts/*') ? 'active' : '' }}" href="/dashboard/posts">
            <span data-feather="file" class="align-text-bottom"></span>
            Posts
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/blog">
            <span data-feather="file" class="align-text-bottom"></span>
            Home
          </a>
        </li>
      </ul>

      {{-- yang bisa mengaksess halaman ini adalah admin dari gate --}}
      @can('admin')

      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
        <span>Administrator</span>
      </h6>

      <ul class="nav flex-column mb-2">

        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard/categories') ? 'active' : '' }}" href="/dashboard/categories">
            <span data-feather="grid" class="align-text-bottom"></span>
            Post Categories
          </a>
        </li>

      </ul>

                
      @endcan


      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
          <span>Action</span>
        </h6>

        <ul class="nav flex-column mb-2">

          <li class="nav-item">
              <form action="/logout" method="post">
                  @csrf
                <button type="submit" class="dropdown-item">
                  <span data-feather="log-out" class="align-text-bottom"></span> Logout</button>
                </form>
          </li>

        </ul>

    </div>
  </nav>