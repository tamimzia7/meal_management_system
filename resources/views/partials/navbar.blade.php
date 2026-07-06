<nav class="top-navbar">
    <div class="navbar-left">
        <button class="toggle-btn" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        <h5 class="page-title">@yield('page-title', 'Dashboard')</h5>
    </div>
    <div class="navbar-right">
        <div class="user-info">
            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="d-none d-md-block">
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
            </div>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i>
                <span class="d-none d-md-inline">Logout</span>
            </button>
        </form>
    </div>
</nav>
