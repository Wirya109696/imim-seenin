<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">MOVIEX</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
              <svg class="bi"><use xlink:href="#house-fill"/></svg>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/list*') ? 'active' : '' }}" href="/dashboard/list">
              <svg class="bi"><use xlink:href="#film"/></svg>
              My List Movie
            </a>
          </li>

        <hr class="my-3">
        @can('admin')
        <h6 class="sidebar-heading d-flex justify-content-between align-item-center px-3 mt-2 mb-1 text-muted">
            Admin Category
        </h6>
        <ul class="nav flex-column mb-auto">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 {{ Request::is('dashboard/categories*') ? 'active' : '' }}" href="/dashboard/categories">
            <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
            List Category
            </a>
        </li>
        @endcan

          <li class="nav-item">
            {{-- <a class="nav-link d-flex align-items-center gap-2" href="/logout">
              <svg class="bi"><use xlink:href="#door-closed"/></svg>
              Logout
            </a> --}}
            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="nav-link d-flex align-items-center gap-2">
                <svg class="bi"><use xlink:href="#door-closed"/></svg>
                Logout
              </button>
          </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
