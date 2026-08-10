<div class="topbar">
    <div class="d-flex align-items-center">
        <button class="mobile-toggle" id="sidebarToggle">
            <i class="bi bi-list fs-4"></i>
        </button>
        <h5 class="ms-3 mb-0">{{ $pageTitle ?? 'Dashboard' }}</h5>
    </div>
    
    <!-- ✅ User Profile (Only show if logged in) -->
    @auth
    <div class="user-profile d-flex align-items-center">
        <span class="text-muted small me-2 d-none d-md-inline">Welcome, {{ Auth::user()->name }}</span>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="" width="32" height="32" class="rounded-circle">
            </a>
        </div>
    </div>
    @else
    <div class="d-flex align-items-center">
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Log In</a>
    </div>
    @endauth
</div>