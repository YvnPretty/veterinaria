<!DOCTYPE html>
<html lang="es">
<head>
    <script>
        if (localStorage.getItem("theme") === "dark") {
            document.documentElement.classList.add("dark-mode");
        }
    </script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard Veterinaria">
    <meta name="author" content="">

    <title>@yield('titulo_pagina') - Veterinaria</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; color: #334155; }
        #wrapper #content-wrapper { background-color: #f4f6f9; }
        .container-fluid { padding: 1.5rem 1.5rem 3rem 1.5rem; }
        @media (min-width: 768px) {
            .container-fluid { padding: 2rem 2.5rem 4rem 2.5rem; }
        }
        
        /* Sidebar Styling */
        .sidebar-light .nav-item .nav-link { 
            color: #64748b; 
            padding: 0.85rem 1.25rem; 
            border-radius: 12px; 
            margin: 0.25rem 15px; 
            width: auto; 
            font-weight: 700; 
            transition: all 0.2s ease;
        }
        .sidebar-light .nav-item.active .nav-link { 
            background-color: #7b61ff; 
            color: #ffffff !important; 
            box-shadow: 0 4px 12px rgba(123, 97, 255, 0.25);
        }
        .sidebar-light .nav-item.active .nav-link i { color: #ffffff !important; }
        .sidebar-light .nav-item .nav-link:hover:not(.active) { 
            background-color: #f1f5f9; 
            color: #512da8; 
            transform: translateX(3px);
        }
        .sidebar-light .nav-item .nav-link i { font-size: 1rem; margin-right: 12px; transition: all 0.2s; }
        
        .sidebar-brand { height: auto; padding: 1.5rem 1rem; margin-bottom: 1rem; }
        .sidebar-heading { 
            padding: 0.75rem 1.5rem 0.5rem; 
            text-transform: uppercase; 
            font-size: 0.7rem; 
            letter-spacing: 0.1em; 
            font-weight: 800; 
            color: #94a3b8; 
        }

        /* Topbar Styling */
        .topbar { height: 4.5rem; border-bottom: 1px solid #e2e8f0 !important; }
        .topbar .nav-item .nav-link { height: 4.5rem; }

        /* Card & UI Defaults */
        .vetcare-card { border: none; border-radius: 20px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.03); }
        .btn { border-radius: 12px; font-weight: 700; padding: 0.6rem 1.25rem; transition: all 0.2s ease; }
        .btn:active { transform: scale(0.98); }
        .btn-vetcare { background-color: #7b61ff; color: white !important; border-radius: 12px; font-weight: 700; padding: 0.5rem 1.5rem; border: none; transition: all 0.2s ease; }
        .btn-vetcare:hover { background-color: #512da8; color: white !important; transform: translateY(-1px); }

        /* Premium Off-Canvas Sidebar Overlay Styles */
        #accordionSidebar {
            position: fixed !important;
            top: 0;
            left: 0;
            height: 100vh !important;
            z-index: 1040;
            width: 260px !important;
            transform: translateX(-100%) !important;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            box-shadow: 5px 0 25px rgba(0,0,0,0.08) !important;
        }

        /* Ensure it remains fully expanded when open (toggled) */
        #accordionSidebar.toggled {
            width: 260px !important;
        }
        #accordionSidebar.toggled .sidebar-brand-text,
        #accordionSidebar.toggled .nav-item .nav-link span,
        #accordionSidebar.toggled .sidebar-heading {
            display: block !important;
            opacity: 1 !important;
        }
        #accordionSidebar.toggled .nav-item .nav-link i {
            margin-right: 12px !important;
        }
        #accordionSidebar.toggled .sidebar-brand {
            text-align: left !important;
        }

        /* Show sidebar when body is toggled */
        body.sidebar-toggled #accordionSidebar {
            transform: translateX(0) !important;
        }

        /* Adjust Content Wrapper to take full width */
        #content-wrapper {
            width: 100% !important;
            padding-left: 0 !important;
            margin-left: 0 !important;
            transition: padding 0.3s ease;
        }

        /* Sidebar Backdrop styles */
        .sidebar-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(15, 23, 42, 0.4); /* Modern slate/dark backdrop */
            backdrop-filter: blur(4px); /* Sleek modern blur effect */
            z-index: 1030;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        /* Custom VetCare Form Controls - Centralized for vertical alignment and styling */
        .form-control-vet {
            height: auto !important;
            padding: 0.75rem 1rem !important;
            border-radius: 12px !important;
            border: 1px solid #e3e6f0 !important;
            color: #3a3b45 !important;
            font-size: 0.95rem !important;
            line-height: 1.5 !important;
            vertical-align: middle !important;
        }
        
        select.form-control-vet {
            appearance: none !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right 1rem center !important;
            background-size: 16px 12px !important;
            padding-right: 2.5rem !important;
        }
        
        .form-control-vet:focus {
            border-color: #7b61ff !important;
            box-shadow: 0 0 0 0.2rem rgba(123, 97, 255, 0.25) !important;
        }

        /* Dark Mode Styling - Fino y Suave */
        .dark-mode {
            background-color: #0f172a !important;
            color: #cbd5e1 !important;
        }
        .dark-mode #wrapper #content-wrapper {
            background-color: #0f172a !important;
        }
        .dark-mode .topbar,
        .dark-mode #accordionSidebar {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        .dark-mode .sidebar-light .nav-item .nav-link {
            color: #94a3b8 !important;
        }
        .dark-mode .sidebar-light .nav-item .nav-link:hover:not(.active) {
            background-color: #334155 !important;
            color: #f8fafc !important;
        }
        .dark-mode .vet-card,
        .dark-mode .card,
        .dark-mode .vetcare-card,
        .dark-mode .search-card,
        .dark-mode .dossier-card,
        .dark-mode .patient-card,
        .dark-mode .timeline-card {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15) !important;
            color: #cbd5e1 !important;
        }
        .dark-mode .patient-card.active {
            border-color: #7b61ff !important;
            background-color: #1e1b4b !important;
        }
        .dark-mode .patient-card:hover:not(.active) {
            border-color: #475569 !important;
            background-color: #334155 !important;
        }
        .dark-mode h1,
        .dark-mode h2,
        .dark-mode h3,
        .dark-mode h4,
        .dark-mode h5,
        .dark-mode h6,
        .dark-mode .text-gray-800,
        .dark-mode .text-gray-900,
        .dark-mode .form-label,
        .dark-mode .sidebar-brand,
        .dark-mode strong {
            color: #f8fafc !important;
        }
        .dark-mode .text-gray-600,
        .dark-mode .text-muted,
        .dark-mode p {
            color: #94a3b8 !important;
        }
        .dark-mode .form-control-vet,
        .dark-mode .form-control {
            background-color: #0f172a !important;
            border-color: #334155 !important;
            color: #f8fafc !important;
        }
        .dark-mode .form-control-vet:focus {
            border-color: #7b61ff !important;
        }
        .dark-mode table,
        .dark-mode table.table-clean td,
        .dark-mode table.table-clean th {
            border-color: #334155 !important;
            color: #cbd5e1 !important;
        }
        .dark-mode .bg-light,
        .dark-mode .timeline::before {
            background-color: #334155 !important;
        }
        .dark-mode .dropdown-menu {
            background-color: #1e293b !important;
            border-color: #334155 !important;
        }
        .dark-mode .dropdown-item {
            color: #cbd5e1 !important;
        }
        .dark-mode .dropdown-item:hover {
            background-color: #334155 !important;
            color: #f8fafc !important;
        }
        .dark-mode footer {
            background-color: #1e293b !important;
            border-top: 1px solid #334155 !important;
        }
        .dark-mode footer span {
            color: #94a3b8 !important;
        }
        .dark-mode select.form-control-vet {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23cbd5e1' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e") !important;
        }

        /* Welcome Banner Styling - Blends directly into body background */
        .welcome-banner {
            background: #f4f6f9 !important;
            border: none !important;
            box-shadow: none !important;
        }
        
        .welcome-banner-img {
            mix-blend-mode: multiply !important;
            opacity: 0.95 !important;
        }
        
        .welcome-banner h2 {
            color: #1f2d3d !important;
        }
        
        .welcome-banner p {
            color: #475569 !important;
        }

        /* Dark Mode Welcome Banner Override */
        .dark-mode .welcome-banner {
            background: #0f172a !important;
        }
        
        .dark-mode .welcome-banner h2 {
            color: #f8fafc !important;
        }
        
        .dark-mode .welcome-banner p {
            color: #cbd5e1 !important;
        }

        .dark-mode .welcome-banner-img {
            mix-blend-mode: multiply !important;
            opacity: 0.85 !important;
        }

        .dark-mode .stat-card {
            background-color: #1e293b !important;
            border-color: #334155 !important;
            color: #cbd5e1 !important;
        }

        body, #wrapper #content-wrapper, .topbar, #accordionSidebar, .card, .vet-card, .form-control-vet {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease !important;
        }
    </style>
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        @if(!Request::is('expedientes*') && !Route::is('expedientes.*'))
        <!-- Sidebar Backdrop -->
        <div id="sidebarBackdrop" class="sidebar-backdrop" style="display: none;"></div>

        <!-- Sidebar -->
        <ul class="navbar-nav bg-white sidebar sidebar-light accordion border-right" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mt-3 mb-3" href="{{ url('/') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-paw"></i>
                </div>
                <div class="sidebar-brand-text mx-3 text-left leading-tight" style="line-height: 1.2;">
                    <div style="font-size: 1.1rem; font-weight: 800;">Sistema Veterinario</div>
                    <div style="font-size: 0.7rem; font-weight: normal; color: #858796;">
                        @if(Auth::check())
                            @if(Auth::user()->rol === 'administrador')
                                Panel de Administración
                            @elseif(Auth::user()->rol === 'usuario')
                                Área de Cliente
                            @else
                                Clínica Veterinaria
                            @endif
                        @else
                            Clínica Veterinaria
                        @endif
                    </div>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Gestión
            </div>

            @if(Auth::check())
                @if(Auth::user()->rol === 'administrador')
                    <!-- Administrador Menu -->
                    <li class="nav-item {{ Route::is('usuarios.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('usuarios.index') }}">
                            <i class="fas fa-fw fa-users"></i>
                            <span>Usuarios</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Reportes Financieros</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw fa-cogs"></i>
                            <span>Configuración del Sistema</span></a>
                    </li>
                @endif

                @if(Auth::user()->rol === 'administrador' || Auth::user()->rol === 'veterinario')
                    <!-- Heading -->
                    <hr class="sidebar-divider">
                    <div class="sidebar-heading">
                        Gestión Clínica
                    </div>

                    <!-- Veterinario / Administrador Menu -->
                    <li class="nav-item {{ Route::is('pacientes.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pacientes.index') }}">
                            <i class="fas fa-fw fa-paw"></i>
                            <span>Pacientes Mascotas</span></a>
                    </li>
                    <li class="nav-item {{ Route::is('expedientes.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('expedientes.index') }}">
                            <i class="fas fa-fw fa-folder-open"></i>
                            <span>Expedientes</span></a>
                    </li>
                    <li class="nav-item {{ Route::is('citas.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('citas.index') }}">
                            <i class="fas fa-fw fa-calendar-alt"></i>
                            <span>Agenda de Citas</span></a>
                    </li>
                    <li class="nav-item {{ Route::is('historial.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('historial.index') }}">
                            <i class="fas fa-fw fa-notes-medical"></i>
                            <span>Historial Médico</span></a>
                    </li>
                @endif

                @if(Auth::user()->rol === 'usuario')
                    <!-- Usuario/Cliente Menu -->
                    <li class="nav-item {{ Route::is('pacientes.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('pacientes.index') }}">
                            <i class="fas fa-fw fa-paw"></i>
                            <span>Mis Mascotas</span></a>
                    </li>
                    <li class="nav-item {{ Route::is('citas.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('citas.index') }}">
                            <i class="fas fa-fw fa-calendar-alt"></i>
                            <span>Mis Citas</span></a>
                    </li>
                    <li class="nav-item {{ Route::is('historial.*') || Route::is('expedientes.*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('expedientes.index') }}">
                            <i class="fas fa-fw fa-file-medical"></i>
                            <span>Historial Médico</span></a>
                    </li>
                @endif
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        @endif

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    @if(!Request::is('expedientes*') && !Route::is('expedientes.*'))
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars" style="color: #7b61ff; font-size: 1.25rem;"></i>
                    </button>
                    @endif

                    <!-- Topbar Nav Links -->
                    <ul class="navbar-nav mr-auto d-flex align-items-center" style="gap: 10px;">
                        <li class="nav-item">
                            <a href="{{ route('home') }}" 
                               class="btn d-flex align-items-center {{ Route::is('home') ? 'btn-vetcare shadow-sm' : 'text-gray-600' }}" 
                               style="padding: 0.4rem 1.1rem; border-radius: 12px; font-weight: 700; font-size: 0.9rem; transition: all 0.2s; {{ Route::is('home') ? '' : 'background-color: transparent;' }}">
                                <i class="fas fa-home mr-2" style="{{ Route::is('home') ? 'color: white;' : 'color: #7b61ff;' }}"></i>
                                Sistema Veterinario
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('expedientes.index') }}" 
                               class="btn d-flex align-items-center {{ Route::is('expedientes.*') || Request::is('expedientes*') ? 'btn-vetcare shadow-sm' : 'text-gray-600' }}" 
                               style="padding: 0.4rem 1.1rem; border-radius: 12px; font-weight: 700; font-size: 0.9rem; transition: all 0.2s; {{ Route::is('expedientes.*') || Request::is('expedientes*') ? '' : 'background-color: transparent;' }}">
                                <i class="fas fa-folder-open mr-2" style="{{ Route::is('expedientes.*') || Request::is('expedientes*') ? 'color: white;' : 'color: #7b61ff;' }}"></i>
                                Expedientes
                            </a>
                        </li>
                    </ul>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    {{ Auth::check() ? Auth::user()->name : 'Invitado' }}
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::check() ? Auth::user()->profile_photo_url : 'https://startbootstrap.github.io/startbootstrap-sb-admin-2/img/undraw_profile.svg' }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('perfil.index') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#" id="darkModeToggle">
                                    <i class="fas fa-moon fa-sm fa-fw mr-2 text-gray-400" id="darkModeIcon"></i>
                                    <span id="darkModeText">Modo Oscuro</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('contenido')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Veterinaria 2026</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecciona "Cerrar sesión" a continuación si estás listo para finalizar tu sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <!-- If logout is handled via GET route (as it seems in the project), just use href. Otherwise, use a form -->
                    <a class="btn btn-primary" href="{{ route('logout') }}">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        $(document).ready(function() {
            // Function to update backdrop visibility and opacity
            function updateBackdrop() {
                var backdrop = $("#sidebarBackdrop");
                if ($("body").hasClass("sidebar-toggled")) {
                    backdrop.show();
                    // Force a reflow to trigger CSS transition
                    backdrop[0].offsetHeight;
                    backdrop.css("opacity", "1");
                } else {
                    backdrop.css("opacity", "0");
                    setTimeout(function() {
                        if (!$("body").hasClass("sidebar-toggled")) {
                            backdrop.hide();
                        }
                    }, 300);
                }
            }

            // Sync hamburger/backdrop events
            $("#sidebarToggleTop, #sidebarToggle").on("click", function() {
                setTimeout(updateBackdrop, 50);
            });

            // Close sidebar when clicking backdrop
            $("#sidebarBackdrop").on("click", function() {
                $("body").removeClass("sidebar-toggled");
                $("#accordionSidebar").removeClass("toggled");
                updateBackdrop();
            });

            AOS.init({
                duration: 800,
                once: true,
                easing: 'ease-in-out'
            });

            // Dark Mode toggle logic
            const toggleBtn = $("#darkModeToggle");
            const toggleIcon = $("#darkModeIcon");
            const toggleText = $("#darkModeText");

            if ($("html").hasClass("dark-mode")) {
                toggleIcon.removeClass("fa-moon").addClass("fa-sun");
                toggleText.text("Modo Claro");
            }

            toggleBtn.on("click", function(e) {
                e.preventDefault();
                $("html").toggleClass("dark-mode");
                if ($("html").hasClass("dark-mode")) {
                    localStorage.setItem("theme", "dark");
                    toggleIcon.removeClass("fa-moon").addClass("fa-sun");
                    toggleText.text("Modo Claro");
                } else {
                    localStorage.setItem("theme", "light");
                    toggleIcon.removeClass("fa-sun").addClass("fa-moon");
                    toggleText.text("Modo Oscuro");
                }
            });
        });
    </script>

</body>
</html>
