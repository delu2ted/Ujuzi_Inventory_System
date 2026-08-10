<div class="topbar">
    <h5>@yield('title', 'Dashboard')</h5>

    <div class="d-flex align-items-center gap-2">
        <span class="text-muted">Welcome, {{ Auth::user()->name }}</span>
        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random" alt="User Avatar" class="rounded-circle" width="40" height="40">
    </div>
</div>