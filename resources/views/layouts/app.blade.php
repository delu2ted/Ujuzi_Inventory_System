<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- ... head content ... -->
    <link rel="stylesheet" href="css/custom.css'">
</head>
<body>

    <!-- Sidebar Component -->
    @include('layouts.sidebar')

    <!-- Main Content Wrapper -->
    <div class="main-content">
        
        <!-- Mobile Toggle Button -->
        <button class="mobile-toggle" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <!-- Topbar Component -->
        @include('layouts.topbar', ['pageTitle' => $pageTitle ?? 'Dashboard'])

        <!-- Flash Messages & Content -->
        <div class="container-fluid px-0">
            @if(session('success'))
                <!-- ... alerts ... -->
            @endif
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggle = document.getElementById('sidebarToggle');
        
        if (toggle && sidebar) {
            toggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        }
    </script>
</body>
</html>