<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
    <a class="navbar-brand" href="#">Fitness App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
     
        <ul class="navbar-nav " {{(session()->get('userToken')) ? 'hidden' : ''}}>
          <li class="nav-item active">
              <a class="nav-link" href="{{route('login')}}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('register')}}">Register</a>
            </li>
        </ul>
   
          
      <ul class="navbar-nav" {{(session()->get('userToken')) ? '' : 'hidden'}}>
        <li class="nav-item active">
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
          </li>
          
      </ul>

     
    

     
    </div>
    <div>

    </div>
</nav>