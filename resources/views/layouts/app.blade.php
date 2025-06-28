<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Football Atlas')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding-top: 80px;
            font-family: 'Poppins', sans-serif;
            /* Animasi background gradient */
            background-size: 200% 200%;
            animation: gradientMove 12s ease-in-out infinite;
        }
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .navbar-glass {
            background: linear-gradient(90deg, rgba(255,255,255,0.85) 60%, rgba(99,102,241,0.08) 100%);
            backdrop-filter: blur(14px);
            border-bottom: 1.5px solid rgba(99,102,241,0.10);
            box-shadow: 0 6px 24px rgba(99,102,241,0.07);
            transition: background 0.3s;
        }
        .navbar-brand {
            font-weight: 800;
            letter-spacing: 1px;
            font-size: 1.5rem;
            background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: brandPop 1.2s cubic-bezier(.4,2,.6,1);
        }
        @keyframes brandPop {
            0% { letter-spacing: 0.5em; opacity: 0; }
            100% { letter-spacing: 1px; opacity: 1; }
        }
        .nav-link {
            font-weight: 600;
            font-size: 1.08rem;
            transition: color 0.2s, background 0.2s, box-shadow 0.2s;
            border-radius: 0.7rem;
            padding: 0.5rem 1.1rem;
        }
        .nav-link:hover, .nav-link.active {
            color: #6366f1 !important;
            background: rgba(99,102,241,0.08);
            box-shadow: 0 2px 8px rgba(99,102,241,0.10);
        }
        .btn-outline-primary.btn-sm, .btn-primary.btn-sm {
            border-radius: 1.2rem;
            font-weight: 600;
            font-size: 1.05rem;
            box-shadow: 0 2px 8px rgba(99,102,241,0.10);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
        }
        .btn-outline-primary.btn-sm:hover {
            background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
            color: #fff !important;
            border: none;
            box-shadow: 0 6px 24px rgba(99,102,241,0.18);
        }
        .btn-primary.btn-sm {
            background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
            border: none;
        }
        .btn-primary.btn-sm:hover {
            background: linear-gradient(90deg, #60a5fa 0%, #6366f1 100%);
            color: #fff;
            box-shadow: 0 6px 24px rgba(99,102,241,0.18);
        }
        .main-footer {
            background: linear-gradient(90deg, rgba(255,255,255,0.7) 60%, rgba(99,102,241,0.08) 100%);
            backdrop-filter: blur(8px);
            padding: 2rem 0 1.2rem 0;
            margin-top: auto;
            border-top: 1.5px solid rgba(99,102,241,0.10);
            color: #333;
            box-shadow: 0 -4px 24px rgba(99,102,241,0.07);
        }
        .main-footer .brand {
            font-weight: 800;
            font-size: 1.3rem;
            background: linear-gradient(90deg, #6366f1 0%, #60a5fa 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .main-footer .social-link {
            color: #555;
            font-size: 1.7rem;
            transition: color 0.3s, transform 0.3s;
            margin: 0 0.2rem;
        }
        .main-footer .social-link:hover {
            color: #6366f1;
            transform: scale(1.18) translateY(-3px) rotate(-8deg);
        }
        #register-btn:hover {
            color: white !important;
        }
        .spin {
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        /* Responsive Live Search */
        @media (max-width: 768px) {
            #globalSearch {
                width: 200px !important;
            }
        }
        @media (max-width: 576px) {
            #globalSearch {
                width: 150px !important;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top navbar-glass">
        <div class="container">
            <a class="navbar-brand" href="/"><i class="bi bi-football me-2"></i>Football Atlas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('negara.index') }}"><i class="bi bi-flag me-1"></i> Negara</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('klub.index') }}"><i class="bi bi-shield me-1"></i> Klub</a>
                    </li>
                </ul>
                <!-- Global Live Search -->
                <div class="navbar-nav mx-3">
                    <div class="position-relative">
                        <input type="text" id="globalSearch" class="form-control" placeholder="Cari negara/klub..." style="width: 250px; border-radius: 20px; padding-left: 40px; background: rgba(255,255,255,0.9); border: 1px solid rgba(99,102,241,0.2);">
                        <i class="bi bi-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #6366f1;"></i>
                        <div id="searchResults" class="position-absolute w-100 mt-1" style="display: none; z-index: 1000;">
                            <div class="card shadow-lg" style="border-radius: 15px; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
                                <div class="card-body p-0">
                                    <div id="searchContent"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav ms-auto align-items-center">
                    @guest
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary btn-sm px-3" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right me-1"></i> Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm text-white px-3" href="{{ route('register') }}"><i class="bi bi-person-plus me-1"></i> Register</a>
                        </li>
                    @else
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container flex-fill my-5">
        @yield('content')
    </main>

    <footer class="main-footer">
        <div class="container text-center">
            <p class="brand mb-2">Football Atlas</p>
            <p class="text-muted mb-3">&copy; {{ date('Y') }}. Dibuat dengan <i class="bi bi-heart-fill text-danger"></i> oleh Farikhin.</p>
            <div>
                <a href="https://github.com/revigan" class="social-link me-3" target="_blank" title="GitHub"><i class="bi bi-github"></i></a>
                <a href="https://wa.me/6281215413573" class="social-link" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 1080; min-width:320px;">
        <div id="mainToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <span id="toastMessage"></span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- End Toast Container -->
    <script>
    window.showToast = function(message, type = 'success') {
        var toastEl = document.getElementById('mainToast');
        var toastMsg = document.getElementById('toastMessage');
        toastMsg.innerHTML = message;
        toastEl.className = 'toast align-items-center border-0 text-bg-' + (type === 'error' ? 'danger' : type);
        var toast = new bootstrap.Toast(toastEl, { delay: 3500 });
        toast.show();
    };
    
    // Global Live Search
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('globalSearch');
        const searchResults = document.getElementById('searchResults');
        const searchContent = document.getElementById('searchContent');
        let searchTimeout;
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    searchResults.style.display = 'none';
                    return;
                }
                
                // Show loading
                searchContent.innerHTML = `
                    <div class="p-3 text-center">
                        <div class="spinner-border spinner-border-sm text-primary me-2" role="status"></div>
                        <span class="text-muted">Mencari...</span>
                    </div>
                `;
                searchResults.style.display = 'block';
                
                // Debounce search
                searchTimeout = setTimeout(() => {
                    performGlobalSearch(query);
                }, 300);
            });
            
            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.style.display = 'none';
                }
            });
            
            // Handle keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    searchResults.style.display = 'none';
                    searchInput.blur();
                }
            });
        }
        
        function performGlobalSearch(query) {
            // Search in negara
            fetch(`/negara?search=${encodeURIComponent(query)}`)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const negaraRows = doc.querySelectorAll('tbody tr');
                    
                    // Search in klub
                    fetch(`/klub?search=${encodeURIComponent(query)}`)
                        .then(response => response.text())
                        .then(klubHtml => {
                            const klubDoc = parser.parseFromString(klubHtml, 'text/html');
                            const klubRows = klubDoc.querySelectorAll('tbody tr');
                            
                            displayGlobalResults(negaraRows, klubRows, query);
                        })
                        .catch(error => {
                            console.error('Klub search error:', error);
                            displayGlobalResults(negaraRows, [], query);
                        });
                })
                .catch(error => {
                    console.error('Negara search error:', error);
                    displayGlobalResults([], [], query);
                });
        }
        
        function displayGlobalResults(negaraRows, klubRows, query) {
            let html = '';
            let hasResults = false;
            
            // Display negara results
            if (negaraRows.length > 0) {
                html += '<div class="p-2 border-bottom"><small class="text-muted fw-bold"><i class="bi bi-flag me-1"></i>Negara</small></div>';
                negaraRows.forEach((row, index) => {
                    if (index < 3) { // Limit to 3 results
                        const namaCell = row.querySelector('td:nth-child(3) a');
                        if (namaCell) {
                            const nama = namaCell.textContent.trim();
                            const href = namaCell.href;
                            html += `
                                <div class="p-2 border-bottom search-item" onclick="window.location.href='${href}'" style="cursor: pointer;">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-flag text-primary me-2"></i>
                                        <div>
                                            <div class="fw-bold">${nama}</div>
                                            <small class="text-muted">Negara</small>
                                        </div>
                                    </div>
                                </div>
                            `;
                            hasResults = true;
                        }
                    }
                });
            }
            
            // Display klub results
            if (klubRows.length > 0) {
                html += '<div class="p-2 border-bottom"><small class="text-muted fw-bold"><i class="bi bi-shield me-1"></i>Klub</small></div>';
                klubRows.forEach((row, index) => {
                    if (index < 3) { // Limit to 3 results
                        const namaCell = row.querySelector('td:nth-child(3)');
                        if (namaCell) {
                            const nama = namaCell.textContent.trim();
                            const detailLink = row.querySelector('td:last-child a');
                            const href = detailLink ? detailLink.href : '#';
                            html += `
                                <div class="p-2 border-bottom search-item" onclick="window.location.href='${href}'" style="cursor: pointer;">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-shield text-success me-2"></i>
                                        <div>
                                            <div class="fw-bold">${nama}</div>
                                            <small class="text-muted">Klub</small>
                                        </div>
                                    </div>
                                </div>
                            `;
                            hasResults = true;
                        }
                    }
                });
            }
            
            if (!hasResults) {
                html = '<div class="p-3 text-center text-muted">Tidak ada hasil ditemukan</div>';
            }
            
            searchContent.innerHTML = html;
            
            // Add hover effects
            document.querySelectorAll('.search-item').forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = 'rgba(99,102,241,0.1)';
                });
                item.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = 'transparent';
                });
            });
        }
    });
    </script>
</body>
</html> 