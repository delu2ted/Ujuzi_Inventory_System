<div class="sidebar">
    
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        Ujuzi Inventory
    </a>

    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Product List
                </a>
            </li>
            <li>
                <a href="{{ route('products.create') }}" class="nav-link {{ request()->routeIs('products.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i> Create Product
                </a>
            </li>
        </ul>
    </nav>

    <div class="sidebar-footer">
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" class="rounded-circle me-2" width="32" height="32" alt="Avatar">
                <span>{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}"> 
                        @csrf 
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent"> 
                            <i class="bi bi-box-arrow-right"></i> Logout </button> 
                        </form> 
                </li>
            </ul>
        </div>
    </div>
</div>