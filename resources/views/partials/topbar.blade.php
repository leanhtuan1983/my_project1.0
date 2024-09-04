<nav class="topBar">
  <ul class="topBar-nav">
    <li class="topBar-item">
      <img class="topbar-Icons" src="{{ asset('assets/icon/dashboard.png') }}">
      <a class="topBar-link" href="#">DASHBOARD</a>
    </li>
    <li class="topBar-item">
      <img class="topbar-Icons" src="{{ asset('assets/icon/workshop.png') }}">
      <a class="topBar-link" href="#">DEPARTMENT</a>
    </li>
  </ul>
 
        
        
    <div class="user-info">
      <p class = "username">Hello! {{ $sharedData }}</p>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
          <button type="submit" class ="btn-logout"><img class="btn-logout-img" src="{{ asset('assets/icon/switch.png')}}" alt="Log out"></button>
      </form>
    </div>
</nav>