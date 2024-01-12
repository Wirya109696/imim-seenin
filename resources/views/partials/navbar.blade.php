<nav class="navbar navbar-expand-lg navbar-success bg-success">
    <div class="container-fluid">
      <a class="navbar-brand" href="#" style="-webkit-text-fill-color: white" ><b>IMIP-INFO</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          {{-- <li class="nav-item">
            <a class="nav-link {{($active === "home") ? 'active' : ''}}" style="-webkit-text-fill-color: white" aria-current="page" href="/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($active === "about") ? 'active' : ''}}" style="-webkit-text-fill-color: white" href="/about">Film</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link {{($active === "list") ? 'active' : ''}}" style="-webkit-text-fill-color: white" href="/list">List Info</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{($active === "categories") ? 'active' : ''}}" style="-webkit-text-fill-color: white" href="/categories">Category</a>
          </li>
          {{-- <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li> --}}
          {{-- <li class="nav-item">
            <a class="nav-link disabled" aria-disabled="true">Disabled</a>
          </li> --}}
        </ul>
        <ul class="navbar-nav ms-auto">
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Welcome Back ! {{ auth()->user()->name }}
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="/dashboard"><i class="bi bi-border-width"></i> My Dashboard</a></li>
              <li>
                <hr class="dropdown-divider"></li>
              <li>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </li>
            </ul>
          </li>
        @else
            <li class="nav-item">
                <a href="/login" class="nav-link {{($active === "login") ? 'active' : ''}}" style="-webkit-text-fill-color: white"><i class="bi bi-box-arrow-in-right text-white"></i> Login</a>
            </li>
        @endauth
        </ul>


      </div>
    </div>
  </nav>
