<nav class="sidebar d-flex flex-column" id="sidebar">
    <a href="{{ route('products.index') }}" class="sidebar-brand">
        <i class="bi bi-box-seam-fill me-2"></i> Ujuzi Mall
    </a>
    
    <div class="flex-grow-1 mt-3">
        <ul class="nav flex-column sidebar-nav">
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.index') ? 'active' : '' }}">
                    <i class="bi bi-grid-fill"></i> Product List
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.create') }}" class="nav-link {{ request()->routeIs('products.create', 'products.edit') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle-fill"></i> Add Product
                </a>
            </li>
        </ul>
    </div>
    
    <!-- ✅ User Profile (Only show if logged in) -->
    @auth
    <div class="sidebar-footer">
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="" width="32" height="32" class="rounded-circle me-2">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            Sign out <i class="bi bi-box-arrow-right ms-2"></i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @else
    <!-- Optional: Show a placeholder or nothing if not logged in -->
    @endauth
</nav>