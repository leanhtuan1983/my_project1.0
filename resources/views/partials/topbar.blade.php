<nav class="topBar">
  <ul class="topBar-nav">
    <li class="topBar-item">
      <img class="topbar-icon" src="{{ asset('assets/icon/dashboard.png') }}">
      <a class="topBar-link" href="#">DASHBOARD</a>
    </li>
    <li class="topBar-item">
      <img class="topbar-icon" src="{{ asset('assets/icon/workshop.png') }}">
      <a class="topBar-link" href="#">DEPARTMENT</a>
    </li>
  </ul>
    <div class="user-info">
        <p class = "username">Hello! {{ $sharedData }}</p>
        <div class="user-avatar">
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-primary">
        Log Out
    </button>
</form>
        </div>
    </div>
</nav>