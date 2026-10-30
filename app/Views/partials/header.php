<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $sistema->nombre_sistema ?? 'Sistema Taller'; ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Fonts Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        :root {
            --sidebar-width: 260px;
            --primary-orange: #ff5500;
            --orange-bright: #ff6a00;
            --orange-glow: rgba(255, 106, 0, 0.45);
            --dark-sidebar: #060b14;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
        }

        /* SIDEBAR ULTRA-PREMIUM (Fijo / Sticky) */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background-color: var(--dark-sidebar);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 24px 18px;
            z-index: 1030;
            overflow-y: auto;
            overflow-x: hidden;
            box-shadow: 10px 0 35px rgba(0, 0, 0, 0.3);
            border-right: 1.5px solid rgba(255, 106, 0, 0.5);
        }

        /* Scrollbar elegante para el menú si la pantalla es de menor altura */
        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(6, 11, 20, 0.5);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 106, 0, 0.3);
            border-radius: 4px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 106, 0, 0.6);
        }

        /* Contenedor del contenido principal para compensar el sidebar fijo */
        .main-content-wrapper {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            background-color: #f8fafc;
        }

        /* Capa con silueta automotriz tenue de fondo */
        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/img/portadalogin.webp');
            background-size: cover;
            background-position: left center;
            opacity: 0.16;
            filter: grayscale(40%) contrast(1.2);
            pointer-events: none;
            z-index: 0;
        }

        /* Línea de resplandor neón naranja en el borde derecho */
        .sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, 
                rgba(255, 106, 0, 0.2) 0%, 
                #ff6a00 30%, 
                #ffa600 60%, 
                rgba(255, 106, 0, 0.3) 100%
            );
            box-shadow: 0 0 15px #ff6a00, 0 0 30px rgba(255, 106, 0, 0.5);
            pointer-events: none;
            z-index: 2;
        }

        .sidebar-content {
            position: relative;
            z-index: 3;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* BRANDING DEL SIDEBAR */
        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 6px 8px 24px;
            text-decoration: none;
        }

        .brand-logo-svg {
            width: 44px;
            height: 44px;
            filter: drop-shadow(0 2px 8px rgba(255, 106, 0, 0.5));
            flex-shrink: 0;
        }

        .brand-logo-custom {
            max-width: 46px;
            max-height: 46px;
            object-fit: contain;
            filter: drop-shadow(0 2px 8px rgba(255, 106, 0, 0.4));
            border-radius: 8px;
            flex-shrink: 0;
        }

        .brand-text {
            font-family: 'Outfit', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.3px;
            line-height: 1.1;
        }

        .brand-text span {
            color: var(--primary-orange);
        }

        /* LISTA DE NAVEGACIÓN */
        .sidebar-nav {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .sidebar-nav li a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 11px 16px;
            color: #94a3b8;
            font-size: 0.92rem;
            font-weight: 500;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.25s ease;
            position: relative;
        }

        .sidebar-nav li a i {
            font-size: 1.1rem;
            width: 22px;
            text-align: center;
            color: #64748b;
            transition: all 0.25s ease;
        }

        .sidebar-nav li a:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
            transform: translateX(3px);
        }

        .sidebar-nav li a:hover i {
            color: var(--orange-bright);
        }

        /* ÍTEM ACTIVO (DASHBOARD U OTRAS RUTAS) */
        .sidebar-nav li a.active {
            color: #ffffff;
            font-weight: 600;
            background: linear-gradient(90deg, rgba(16, 29, 52, 0.95) 0%, rgba(13, 24, 45, 0.8) 100%);
            border: 1px solid rgba(56, 189, 248, 0.3);
            border-left: 3.5px solid var(--primary-orange);
            box-shadow: 
                0 4px 18px rgba(0, 0, 0, 0.5),
                0 0 15px rgba(56, 189, 248, 0.12);
        }

        .sidebar-nav li a.active i {
            color: var(--orange-bright);
            filter: drop-shadow(0 0 6px rgba(255, 106, 0, 0.6));
        }

        /* SECCIÓN DE ADMINISTRACIÓN */
        .nav-category {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 2px;
            color: #475569;
            text-transform: uppercase;
            padding: 22px 14px 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* CARD DE USUARIO INFERIOR */
        .sidebar-footer {
            position: relative;
            z-index: 3;
            padding-top: 18px;
        }

        .user-pill-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            background: rgba(13, 20, 36, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            padding: 8px 14px;
            color: #ffffff;
            text-decoration: none;
            backdrop-filter: blur(10px);
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35);
        }

        .user-pill-btn:hover {
            background: rgba(18, 28, 48, 0.95);
            border-color: rgba(255, 106, 0, 0.4);
            color: #ffffff;
            box-shadow: 0 6px 18px rgba(255, 106, 0, 0.2);
        }

        .user-badge-avatar {
            width: 34px;
            height: 34px;
            background: linear-gradient(135deg, #ff5500 0%, #ff7700 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 0.78rem;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(255, 85, 0, 0.5);
            flex-shrink: 0;
        }

        .user-pill-info {
            flex-grow: 1;
            padding: 0 10px;
            text-align: left;
            overflow: hidden;
        }

        .user-pill-name {
            font-weight: 600;
            font-size: 0.88rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #f1f5f9;
        }

        .user-pill-arrow {
            font-size: 0.75rem;
            color: #94a3b8;
            transition: transform 0.2s ease;
        }

        /* Menú desplegable dark estilizado */
        .dropdown-menu-dark-custom {
            background: #0d1525;
            border: 1px solid rgba(255, 106, 0, 0.3);
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.7);
            padding: 8px;
            min-width: 210px;
        }

        .dropdown-menu-dark-custom .dropdown-item-text {
            color: #e2e8f0 !important;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 8px 12px;
            display: flex;
            align-items: center;
        }

        .dropdown-menu-dark-custom .dropdown-item {
            border-radius: 8px;
            padding: 8px 12px;
            font-size: 0.85rem;
            color: #cbd5e1;
            transition: all 0.2s;
        }

        .dropdown-menu-dark-custom .dropdown-item:hover {
            background: rgba(255, 106, 0, 0.15);
            color: #ff8c00;
        }

        .dropdown-menu-dark-custom .dropdown-item.text-danger:hover {
            background: rgba(239, 68, 68, 0.15);
            color: #f87171 !important;
        }

        /* AJUSTES GLOBALES */
        .card { border: none; box-shadow: 0 0 15px rgba(0,0,0,0.05); border-radius: 12px; }
        .card-header { background: white; border-bottom: 1px solid #eee; padding: 15px; font-weight: bold; }
        .dt-buttons .btn { font-size: 0.8rem; padding: 0.25rem 0.5rem; }
        .select2-container--bootstrap-5 .select2-selection { border-color: #dee2e6; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- SIDEBAR ULTRA-PREMIUM -->
    <div class="sidebar">
        <div class="sidebar-content">
            <!-- Brand Logo Dinámico -->
            <a href="/" class="sidebar-brand">
                <?php if (!empty($sistema->logo) && file_exists(__DIR__ . '/../../../public/uploads/logo/' . $sistema->logo)): ?>
                    <img src="/uploads/logo/<?php echo htmlspecialchars($sistema->logo); ?>" class="brand-logo-custom" alt="Logo">
                <?php else: ?>
                    <svg class="brand-logo-svg" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M43 14H57V22C59.5 22.7 61.8 23.7 64 25L70.5 19L80.4 28.9L74.4 35.4C75.7 37.6 76.7 39.9 77.4 42.4H85.4V56.4H77.4C76.7 58.9 75.7 61.2 74.4 63.4L80.4 69.9L70.5 79.8L64 73.8C61.8 75.1 59.5 76.1 57 76.8V84.8H43V76.8C40.5 76.1 38.2 75.1 36 73.8L29.5 79.8L19.6 69.9L25.6 63.4C24.3 61.2 23.3 58.9 22.6 56.4H14.6V42.4H22.6C23.3 39.9 24.3 37.6 25.6 35.4L19.6 28.9L29.5 19L36 25C38.2 23.7 40.5 22.7 43 22V14Z" fill="#FF5500"/>
                        <circle cx="50" cy="49" r="21" fill="#060B14"/>
                        <path d="M26 50C26 47 34 40 50 40C66 40 74 47 74 50L77 56H23L26 50Z" fill="#FFFFFF"/>
                        <path d="M30 49L35 43H65L70 49H30Z" fill="#060B14"/>
                        <path d="M28 58C28 56.5 35 55 50 55C65 55 72 56.5 72 58L70 63H30L28 58Z" fill="#CBD5E1"/>
                        <circle cx="34" cy="63" r="5" fill="#FFFFFF"/>
                        <circle cx="34" cy="63" r="2.5" fill="#FF5500"/>
                        <circle cx="66" cy="63" r="5" fill="#FFFFFF"/>
                        <circle cx="66" cy="63" r="2.5" fill="#FF5500"/>
                        <path d="M22 69H78V72H22V69Z" fill="#FFFFFF"/>
                    </svg>
                <?php endif; ?>
                <div class="brand-text">
                    <?php 
                        $nom = $sistema->nombre_sistema ?? 'Taller Pro';
                        $partes = explode(' ', $nom, 2);
                        echo htmlspecialchars($partes[0]);
                        if(isset($partes[1])) echo ' <span>' . htmlspecialchars($partes[1]) . '</span>';
                    ?>
                </div>
            </a>

            <!-- Navigation Links -->
            <ul class="sidebar-nav">
                <li>
                    <a href="/" class="<?php echo ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == '') ? 'active' : ''; ?>">
                        <i class="fa-solid fa-table-cells-large"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="/ordenes" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/ordenes') !== false) ? 'active' : ''; ?>">
                        <i class="fa-regular fa-clipboard"></i>
                        <span>Órdenes</span>
                    </a>
                </li>
                <li>
                    <a href="/clientes" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/clientes') !== false) ? 'active' : ''; ?>">
                        <i class="fa-solid fa-users"></i>
                        <span>Clientes</span>
                    </a>
                </li>
                <li>
                    <a href="/productos" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/productos') !== false) ? 'active' : ''; ?>">
                        <i class="fa-solid fa-box-archive"></i>
                        <span>Inventario</span>
                    </a>
                </li>
                <li>
                    <a href="/ventas" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/ventas') !== false) ? 'active' : ''; ?>">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Ventas</span>
                    </a>
                </li>

                <!-- Categoría Administración -->
                <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <div class="nav-category">Administración</div>
                    <li>
                        <a href="/gastos" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/gastos') !== false) ? 'active' : ''; ?>">
                            <i class="fa-regular fa-money-bill-1"></i>
                            <span>Gastos</span>
                        </a>
                    </li>
                    <li>
                        <a href="/reportes" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/reportes') !== false) ? 'active' : ''; ?>">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span>Reportes</span>
                        </a>
                    </li>
                    <li>
                        <a href="/usuarios" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/usuarios') !== false) ? 'active' : ''; ?>">
                            <i class="fa-regular fa-user"></i>
                            <span>Personal</span>
                        </a>
                    </li>
                    <li>
                        <a href="/configuracion" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/configuracion') !== false) ? 'active' : ''; ?>">
                            <i class="fa-solid fa-gear"></i>
                            <span>Configuración</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- USER PILL FOOTER -->
        <div class="sidebar-footer">
            <div class="dropdown">
                <?php 
                    $userName = $_SESSION['user_name'] ?? 'Administrador';
                    $userInitials = strtoupper(substr($userName, 0, 2));
                    if (empty($userInitials)) $userInitials = 'AD';
                ?>
                <a href="#" class="user-pill-btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="user-badge-avatar"><?php echo $userInitials; ?></div>
                    <div class="user-pill-info">
                        <div class="user-pill-name"><?php echo htmlspecialchars($userName); ?></div>
                    </div>
                    <i class="fa-solid fa-chevron-down user-pill-arrow"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark-custom text-small shadow">
                    <li>
                        <span class="dropdown-item-text">
                            <i class="fa-solid fa-shield-halved me-2 text-warning fs-6"></i>
                            <span>Rol:&nbsp;<strong class="text-white"><?php echo ucfirst($_SESSION['user_role'] ?? 'admin'); ?></strong></span>
                        </span>
                    </li>
                    <li><hr class="dropdown-divider border-secondary opacity-25"></li>
                    <li><a class="dropdown-item text-danger" href="/logout"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content-wrapper">
        <div class="container-fluid p-4" style="width: 100%;">
