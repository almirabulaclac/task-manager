<nav class="navbar navbar-expand-lg navbar-dark py-2 fixed-top" style="background-color: #0C1434;">
  <div class="container-fluid">
    <!-- Brand Logo & Name -->
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <img src="{{ asset('images/task.png') }}" alt="Logo" width="40" height="40" class="d-inline-block align-text-middle">
      <span class="d-none d-md-inline chewy-regular">Flowboard</span>
      <span class="d-inline d-md-none chewy-regular">Flowboard</span> 
    </a>

    <!-- Toggle Button for Mobile (Hamburger Menu on the Right) -->
    <button class="navbar-toggler ms-auto border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <i class="fa-solid fa-bars text-white"></i> 
    </button>

    <!-- Collapsible Navbar Content (Align to Right) -->
    <div class="collapse navbar-collapse justify-content-end text-end" id="navbarNav">
      <ul class="navbar-nav gap-3">
        <li class="nav-item">
          <a class="btn" href="{{-- route('login.form') --}}" style="background-color: #CADCFC;"><b>LOGIN</b> <i class="fa-solid fa-user"></i></a>
        </li>
        <li class="nav-item">
          <a class="btn" href="{{-- route('register.form') --}}" style="background-color: #CADCFC;"><b>REGISTER</b> <i class="fa-solid fa-right-to-bracket"></i></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
            <span class="d-none d-md-inline" style="border-left: 1px solid white; padding-left: 10px;"></span>
            <i class="fa-solid fa-circle-user"></i> <b>EMPLOYEE LOGIN</b>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="loginDropdown">
            <li><a class="dropdown-item" href="{{-- route('hr_login.form') --}}">HR Login</a></li>
            <li><a class="dropdown-item" href="{{-- route('enduser_login.form') --}}">End-User Login</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>