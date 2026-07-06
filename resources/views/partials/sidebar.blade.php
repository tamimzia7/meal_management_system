<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}" class="logo">
            <i class="bi bi-cup-hot-fill"></i>
            <div>
                <span>MealSys</span>
                <small>Management System</small>
            </div>
        </a>
    </div>

    <div class="nav-menu">
        <div class="menu-title">Main Menu</div>

        <div class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>
        </div>

        <div class="menu-title">Management</div>

        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#userMenu" role="button">
                <i class="bi bi-people-fill"></i>
                <span>User Management</span>
                <i class="bi bi-chevron-right collapse-icon ms-auto"></i>
            </a>
            <div class="collapse {{ request()->routeIs('users.*') ? 'show' : '' }}" id="userMenu">
                <ul class="collapse-menu">
                    <li>
                        <a href="{{ route('users.create') }}" class="nav-link {{ request()->routeIs('users.create') ? 'active' : '' }}">
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Create Account</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.index') ? 'active' : '' }}">
                            <i class="bi bi-person-lines-fill"></i>
                            <span>Update Account</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#companyMenu" role="button">
                <i class="bi bi-building-fill"></i>
                <span>Company Management</span>
                <i class="bi bi-chevron-right collapse-icon ms-auto"></i>
            </a>
            <div class="collapse {{ request()->routeIs('companies.*') ? 'show' : '' }}" id="companyMenu">
                <ul class="collapse-menu">
                    <li>
                        <a href="{{ route('companies.create') }}" class="nav-link {{ request()->routeIs('companies.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-circle-fill"></i>
                            <span>Create Company</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('companies.index') }}" class="nav-link {{ request()->routeIs('companies.index') ? 'active' : '' }}">
                            <i class="bi bi-pencil-square"></i>
                            <span>Update Company</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="menu-title">Meals</div>

        <div class="nav-item">
            <a class="nav-link {{ request()->routeIs('daily-meals.*') ? 'active' : '' }}" data-bs-toggle="collapse" href="#mealMenu" role="button">
                <i class="bi bi-basket-fill"></i>
                <span>Meal Management</span>
                <i class="bi bi-chevron-right collapse-icon ms-auto"></i>
            </a>
            <div class="collapse {{ request()->routeIs('daily-meals.*') ? 'show' : '' }}" id="mealMenu">
                <ul class="collapse-menu">
                    <li>
                        <a href="{{ route('daily-meals.create') }}" class="nav-link {{ request()->routeIs('daily-meals.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-square-fill"></i>
                            <span>Daily Meal</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('daily-meals.index') }}" class="nav-link {{ request()->routeIs('daily-meals.index') ? 'active' : '' }}">
                            <i class="bi bi-table"></i>
                            <span>Meal List</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="menu-title">Settings</div>

        <div class="nav-item">
            <a href="{{ route('settings.meal-rate') }}" class="nav-link {{ request()->routeIs('settings.meal-rate') ? 'active' : '' }}">
                <i class="bi bi-cash-stack"></i>
                <span>Meal Rate</span>
            </a>
        </div>
    </div>
</nav>
