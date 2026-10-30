<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso de Administrador - Taller Mecánico</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-orange: #ff5500;
            --orange-bright: #ff6a00;
            --orange-glow: rgba(255, 106, 0, 0.45);
            --dark-card: rgba(13, 20, 36, 0.88);
            --dark-input: rgba(18, 28, 48, 0.78);
            --text-muted: #94a3b8;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background-color: #080c14;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            color: #ffffff;
            position: relative;
        }

        /* Contenedor Principal Split */
        .login-wrapper {
            position: relative;
            width: 100vw;
            min-height: 100vh;
            display: flex;
            overflow: hidden;
            background: #090d16;
        }

        /* Capa de fondo limpia con la imagen de taller */
        .bg-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/img/portadalogin.webp');
            background-size: cover;
            background-position: center;
            opacity: 1;
            z-index: 1;
        }

        /* Sombra degradada focalizada únicamente en la zona de textos (Vignette suave) */
        .brand-vignette {
            position: absolute;
            top: 0;
            left: 0;
            width: 55%;
            height: 100%;
            background: radial-gradient(ellipse at 15% 15%, rgba(6, 10, 18, 0.88) 0%, rgba(6, 10, 18, 0.45) 50%, transparent 80%);
            z-index: 2;
            pointer-events: none;
        }

        /* Contenido interactivo por encima de fondos */
        .content-container {
            position: relative;
            z-index: 4;
            display: flex;
            width: 100%;
            height: 100vh;
            padding: 45px 70px;
        }

        /* SECCIÓN IZQUIERDA: Textos y Branding recreados con nitidez */
        .brand-section {
            flex: 1.15;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-right: 40px;
            user-select: none;
        }

        /* Header con Logotipo */
        .brand-header {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .brand-logo-img {
            max-width: 85px;
            max-height: 85px;
            object-fit: contain;
            border-radius: 12px;
            filter: drop-shadow(0 6px 18px rgba(0, 0, 0, 0.95)) drop-shadow(0 2px 10px rgba(255, 106, 0, 0.5));
            background: rgba(255, 255, 255, 0.05);
            padding: 4px;
        }

        .brand-logo-svg {
            width: 78px;
            height: 78px;
            filter: drop-shadow(0 6px 18px rgba(0, 0, 0, 0.95)) drop-shadow(0 2px 10px rgba(255, 106, 0, 0.6));
        }

        .brand-title-wrap h1 {
            font-size: 2.3rem;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            letter-spacing: 0.5px;
            color: #ffffff;
            line-height: 1;
            text-transform: uppercase;
            text-shadow: 0 3px 12px rgba(0, 0, 0, 0.95), 0 1px 3px rgba(0, 0, 0, 0.8);
        }

        .brand-title-wrap h2 {
            font-size: 1.9rem;
            font-weight: 800;
            font-family: 'Outfit', sans-serif;
            color: var(--primary-orange);
            letter-spacing: 1px;
            text-transform: uppercase;
            line-height: 1.1;
            text-shadow: 0 3px 14px rgba(0, 0, 0, 0.95), 0 0 20px rgba(255, 85, 0, 0.4);
        }

        .brand-subtitle {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 4px;
            color: #cbd5e1;
            text-transform: uppercase;
            margin-top: 5px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.9);
        }

        .brand-tagline {
            font-size: 1.1rem;
            color: #ffffff;
            margin-top: 25px;
            font-weight: 500;
            letter-spacing: 0.2px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.95), 0 4px 16px rgba(0, 0, 0, 0.8);
        }

        /* Tarjetas de características inferiores */
        .features-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
            max-width: 680px;
            margin-bottom: 25px;
        }

        .feature-box {
            background: rgba(13, 20, 36, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            padding: 16px 12px;
            text-align: center;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(0,0,0,0.45);
        }

        .feature-box:hover {
            transform: translateY(-3px);
            border-color: rgba(255, 106, 0, 0.5);
            box-shadow: 0 10px 25px rgba(255, 106, 0, 0.2);
        }

        .feature-icon {
            font-size: 1.55rem;
            color: var(--primary-orange);
            margin-bottom: 8px;
            display: inline-block;
        }

        .feature-text {
            font-size: 0.76rem;
            font-weight: 600;
            color: #e2e8f0;
            line-height: 1.25;
        }

        /* Subfooter inferior */
        .brand-footer {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 2.5px;
            color: #e2e8f0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.9);
        }

        .brand-footer .line {
            width: 34px;
            height: 3px;
            background: var(--primary-orange);
            border-radius: 2px;
            box-shadow: 0 0 10px rgba(255, 106, 0, 0.8);
        }

        /* SECCIÓN DERECHA: Card de Login con Borde de Luz Giratorio */
        .login-section {
            flex: 0.85;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 35px;
        }

        .login-card-container {
            width: 100%;
            max-width: 445px;
            position: relative;
            border-radius: 26px;
            padding: 2px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8);
        }

        /* Rayo de luz giratorio 360 grados en el borde */
        .login-card-container::before {
            content: '';
            position: absolute;
            width: 180%;
            height: 180%;
            background: conic-gradient(
                transparent 0deg,
                transparent 45deg,
                rgba(255, 85, 0, 0.3) 90deg,
                #ff6a00 135deg,
                #ffa600 160deg,
                #ff5500 180deg,
                transparent 220deg,
                transparent 360deg
            );
            animation: rotateBorder 4s linear infinite;
            z-index: 0;
        }

        /* Halo difuso exterior adicional que acompaña el giro */
        .login-card-container::after {
            content: '';
            position: absolute;
            width: 180%;
            height: 180%;
            background: conic-gradient(
                transparent 0deg,
                transparent 60deg,
                rgba(255, 106, 0, 0.5) 140deg,
                #ff6a00 160deg,
                transparent 200deg,
                transparent 360deg
            );
            filter: blur(20px);
            animation: rotateBorder 4s linear infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes rotateBorder {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        /* Tarjeta interna sobrepuesta al efecto giratorio */
        .login-card {
            background: rgba(13, 20, 36, 0.94);
            border-radius: 24px;
            padding: 44px 38px;
            backdrop-filter: blur(28px);
            -webkit-backdrop-filter: blur(28px);
            position: relative;
            z-index: 1;
            width: 100%;
            height: 100%;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Escudo Superior */
        .shield-icon-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .shield-badge {
            width: 66px;
            height: 66px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .shield-badge svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 4px 14px rgba(255, 106, 0, 0.35));
        }

        /* Títulos Ultra Premium */
        .login-title {
            text-align: center;
            font-family: 'Outfit', sans-serif;
            font-size: 1.68rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }

        .login-title span {
            background: linear-gradient(135deg, #ff5500 0%, #ff8c00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .login-sub {
            text-align: center;
            font-size: 0.88rem;
            color: var(--text-muted);
            margin-bottom: 30px;
            font-weight: 400;
            letter-spacing: 0.2px;
        }

        /* Inputs Oscuros Ergonómicos con Micro-Glow */
        .input-group-dark {
            position: relative;
            background: var(--dark-input);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 14px;
            display: flex;
            align-items: center;
            margin-bottom: 18px;
            padding: 3px 16px;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-group-dark:focus-within {
            border-color: rgba(255, 115, 0, 0.7);
            box-shadow: 0 0 0 4px rgba(255, 106, 0, 0.15), 0 0 15px rgba(255, 106, 0, 0.12);
            background: rgba(22, 34, 58, 0.96);
        }

        .input-group-dark i.field-icon {
            color: #64748b;
            font-size: 1.05rem;
            margin-right: 12px;
            transition: color 0.2s;
        }

        .input-group-dark:focus-within i.field-icon {
            color: var(--primary-orange);
        }

        .input-group-dark input {
            background: transparent;
            border: none;
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 500;
            padding: 13px 0;
            width: 100%;
            outline: none;
            letter-spacing: 0.2px;
        }

        .input-group-dark input::placeholder {
            color: #64748b;
            font-weight: 400;
        }

        .toggle-btn {
            background: transparent;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 8px;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            transition: color 0.2s;
        }

        .toggle-btn:hover {
            color: #cbd5e1;
        }

        /* Checkbox Recordarme */
        .remember-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 26px;
            cursor: pointer;
            user-select: none;
        }

        .custom-checkbox {
            position: relative;
            width: 19px;
            height: 19px;
            background: var(--primary-orange);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 7px rgba(255, 106, 0, 0.35);
            transition: all 0.2s ease;
        }

        .custom-checkbox i {
            color: #ffffff;
            font-size: 11px;
            font-weight: 900;
        }

        .remember-text {
            font-size: 0.88rem;
            color: #cbd5e1;
            font-weight: 500;
        }

        /* Botón Naranja Vibrante con Acabado Táctil */
        .btn-submit-orange {
            width: 100%;
            background: linear-gradient(90deg, #ff5500 0%, #ff6a00 50%, #ff8000 100%);
            border: none;
            border-radius: 14px;
            padding: 15px 22px;
            font-size: 1.02rem;
            font-weight: 700;
            font-family: 'Outfit', sans-serif;
            color: #ffffff;
            letter-spacing: 0.4px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            box-shadow: 0 6px 22px rgba(255, 85, 0, 0.45);
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-submit-orange:hover {
            background: linear-gradient(90deg, #ff4500 0%, #ff5e00 50%, #ff7700 100%);
            box-shadow: 0 8px 30px rgba(255, 85, 0, 0.65);
            transform: translateY(-2px);
        }

        .btn-submit-orange:active {
            transform: translateY(1px);
        }

        .btn-submit-orange:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Separador Inferior */
        .card-divider {
            display: flex;
            align-items: center;
            margin: 28px 0 16px;
            color: #475569;
            font-size: 0.8rem;
        }

        .card-divider::before,
        .card-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.08);
        }

        .card-divider span {
            padding: 0 12px;
            color: #64748b;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        /* Candado Seguro */
        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 0.82rem;
            color: #94a3b8;
            font-weight: 500;
        }

        .security-badge i {
            color: #38bdf8;
            font-size: 0.95rem;
        }

        /* Enlace a Rastreo de Órdenes */
        .rastreo-link {
            display: block;
            text-align: center;
            margin-top: 14px;
            font-size: 0.82rem;
            color: #64748b;
            text-decoration: none;
            transition: color 0.2s;
        }

        .rastreo-link:hover {
            color: var(--primary-orange);
            text-decoration: underline;
        }

        /* Alerta Flash de Error */
        .flash-alert {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
            padding: 11px 16px;
            border-radius: 12px;
            font-size: 0.88rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 1024px) {
            .content-container {
                flex-direction: column;
                height: auto;
                padding: 40px 24px;
                justify-content: center;
                align-items: center;
            }
            .brand-section {
                padding-right: 0;
                margin-bottom: 35px;
                text-align: center;
                align-items: center;
            }
            .brand-header {
                justify-content: center;
            }
            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .login-section {
                padding-right: 0;
                justify-content: center;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .features-grid {
                display: none;
            }
            .brand-footer {
                display: none;
            }
            .login-card {
                padding: 34px 24px;
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <!-- Capa de imagen de fondo limpia -->
    <div class="bg-layer"></div>
    <!-- Viñeta focalizada para legibilidad de textos -->
    <div class="brand-vignette"></div>

    <div class="content-container">
        <!-- LADO IZQUIERDO: Branding, Logo y Módulos -->
        <div class="brand-section">
            <div>
                <!-- Logotipo Superior -->
                <div class="brand-header">
                    <?php 
                    $logoPath = !empty($sistema->logo) ? __DIR__ . '/../../../public/uploads/logo/' . $sistema->logo : null;
                    if (!empty($sistema->logo) && file_exists($logoPath)): 
                    ?>
                        <img src="/uploads/logo/<?= htmlspecialchars($sistema->logo) ?>" alt="<?= htmlspecialchars($sistema->nombre_sistema ?? 'Taller') ?>" class="brand-logo-img">
                    <?php else: ?>
                        <!-- SVG personalizado con engranaje + silueta de auto + llave inglesa -->
                        <svg class="brand-logo-svg" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Engranaje superior naranja -->
                            <path d="M43 14H57V22C59.5 22.7 61.8 23.7 64 25L70.5 19L80.4 28.9L74.4 35.4C75.7 37.6 76.7 39.9 77.4 42.4H85.4V56.4H77.4C76.7 58.9 75.7 61.2 74.4 63.4L80.4 69.9L70.5 79.8L64 73.8C61.8 75.1 59.5 76.1 57 76.8V84.8H43V76.8C40.5 76.1 38.2 75.1 36 73.8L29.5 79.8L19.6 69.9L25.6 63.4C24.3 61.2 23.3 58.9 22.6 56.4H14.6V42.4H22.6C23.3 39.9 24.3 37.6 25.6 35.4L19.6 28.9L29.5 19L36 25C38.2 23.7 40.5 22.7 43 22V14Z" fill="#FF5500"/>
                            <!-- Centro oscuro de engranaje -->
                            <circle cx="50" cy="49" r="21" fill="#090D16"/>
                            <!-- Silueta blanca estilizada de auto -->
                            <path d="M26 50C26 47 34 40 50 40C66 40 74 47 74 50L77 56H23L26 50Z" fill="#FFFFFF"/>
                            <path d="M30 49L35 43H65L70 49H30Z" fill="#090D16"/>
                            <!-- Llave inglesa en la base del auto -->
                            <path d="M28 58C28 56.5 35 55 50 55C65 55 72 56.5 72 58L70 63H30L28 58Z" fill="#CBD5E1"/>
                            <circle cx="34" cy="63" r="5" fill="#FFFFFF"/>
                            <circle cx="34" cy="63" r="2.5" fill="#FF5500"/>
                            <circle cx="66" cy="63" r="5" fill="#FFFFFF"/>
                            <circle cx="66" cy="63" r="2.5" fill="#FF5500"/>
                            <!-- Llave mecánica cruzada -->
                            <path d="M22 69H78V72H22V69Z" fill="#FFFFFF"/>
                        </svg>
                    <?php endif; ?>

                    <div class="brand-title-wrap">
                        <?php 
                        $brandNombre = trim($sistema->nombre_sistema ?? 'Taller Pro');
                        $brandWords = explode(' ', $brandNombre, 2);
                        $firstWord = $brandWords[0] ?? 'Taller';
                        $secondWord = $brandWords[1] ?? 'Pro';
                        ?>
                        <h1><?= htmlspecialchars($firstWord) ?></h1>
                        <h2><?= htmlspecialchars($secondWord) ?></h2>
                        <div class="brand-subtitle">Sistema de Gestión</div>
                    </div>
                </div>

                <p class="brand-tagline">Control total de tu taller desde un solo lugar</p>
            </div>

            <!-- Características inferiores -->
            <div>
                <div class="features-grid">
                    <div class="feature-box">
                        <i class="fa-solid fa-chart-column feature-icon"></i>
                        <div class="feature-text">Órdenes<br>de trabajo</div>
                    </div>
                    <div class="feature-box">
                        <i class="fa-solid fa-users feature-icon"></i>
                        <div class="feature-text">Clientes<br>y vehículos</div>
                    </div>
                    <div class="feature-box">
                        <i class="fa-solid fa-box-open feature-icon"></i>
                        <div class="feature-text">Inventario<br>de repuestos</div>
                    </div>
                    <div class="feature-box">
                        <i class="fa-solid fa-gear feature-icon"></i>
                        <div class="feature-text">Reportes<br>y estadísticas</div>
                    </div>
                </div>

                <!-- Footer Izquierdo -->
                <div class="brand-footer">
                    <div class="line"></div>
                    <span>ADMINISTRACIÓN &nbsp;|&nbsp; CONTROL &nbsp;|&nbsp; CRECIMIENTO</span>
                </div>
            </div>
        </div>

        <!-- LADO DERECHO: Tarjeta de Acceso con Borde Giratorio -->
        <div class="login-section">
            <div class="login-card-container">
                <div class="login-card">
                    <!-- Escudo con Engranaje -->
                    <div class="shield-icon-wrap">
                        <div class="shield-badge">
                            <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M50 10L82 22V50C82 70 68 86 50 92C32 86 18 70 18 50V22L50 10Z" fill="rgba(24, 34, 54, 0.8)" stroke="#38BDF8" stroke-width="2.5"/>
                                <!-- Engranaje interior naranja vibrante -->
                                <circle cx="50" cy="50" r="14" fill="#FF5500"/>
                                <circle cx="50" cy="50" r="6" fill="#0B111E"/>
                                <path d="M47 30H53V36H47V30ZM47 64H53V70H47V64ZM64 47H70V53H64V47ZM30 47H36V53H30V47Z" fill="#FF5500"/>
                            </svg>
                        </div>
                    </div>

                    <h2 class="login-title">Acceso de <span>Administrador</span></h2>
                    <p class="login-sub">Ingresa a tu cuenta para gestionar el taller</p>

                    <!-- Mensajes Flash de error -->
                    <?php if (!empty($flash_error)): ?>
                        <div class="flash-alert">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span><?= htmlspecialchars($flash_error) ?></span>
                        </div>
                    <?php endif; ?>

                    <form id="adminLoginForm" action="/login/auth" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">

                        <!-- Input Correo Electrónico -->
                        <div class="input-group-dark">
                            <i class="fa-regular fa-envelope field-icon"></i>
                            <input type="email" id="email" name="email" placeholder="Correo electrónico" required autofocus autocomplete="email">
                        </div>

                        <!-- Input Contraseña con Toggle -->
                        <div class="input-group-dark">
                            <i class="fa-solid fa-lock field-icon"></i>
                            <input type="password" id="password" name="password" placeholder="Contraseña" required autocomplete="current-password">
                            <button type="button" class="toggle-btn" id="togglePasswordBtn" title="Ver contraseña">
                                <i class="fa-regular fa-eye-slash" id="toggleEyeIcon"></i>
                            </button>
                        </div>

                        <!-- Checkbox Recordarme -->
                        <label class="remember-container" for="rememberMeCheckbox">
                            <div class="custom-checkbox">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <input type="checkbox" id="rememberMeCheckbox" name="remember" checked style="display: none;">
                            <span class="remember-text">Recordarme</span>
                        </label>

                        <!-- Botón Submit Naranja -->
                        <button type="submit" id="submitBtn" class="btn-submit-orange">
                            <span id="btnIcon"><i class="fa-solid fa-arrow-right-to-bracket"></i></span>
                            <span id="btnText">Iniciar sesión</span>
                        </button>
                    </form>

                    <!-- Divisor -->
                    <div class="card-divider">
                        <span>Acceso exclusivo para administradores</span>
                    </div>

                    <!-- Candado de Seguridad -->
                    <div class="security-badge">
                        <i class="fa-solid fa-lock"></i>
                        <span>Sistema seguro y protegido</span>
                    </div>

                    <!-- Enlace a Rastreo de Órdenes -->
                    <a href="/rastreo" class="rastreo-link">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> ¿Eres cliente? Consulta el estado de tu vehículo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 1. Mostrar/Ocultar contraseña
    const togglePasswordBtn = document.getElementById('togglePasswordBtn');
    const passwordInput = document.getElementById('password');
    const toggleEyeIcon = document.getElementById('toggleEyeIcon');

    togglePasswordBtn.addEventListener('click', () => {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        
        if (isPassword) {
            toggleEyeIcon.classList.replace('fa-eye-slash', 'fa-eye');
        } else {
            toggleEyeIcon.classList.replace('fa-eye', 'fa-eye-slash');
        }
    });

    // 2. Interacción del Checkbox Recordarme
    const rememberCheckbox = document.getElementById('rememberMeCheckbox');
    const customCheckbox = document.querySelector('.custom-checkbox');
    const rememberContainer = document.querySelector('.remember-container');

    rememberContainer.addEventListener('click', (e) => {
        e.preventDefault();
        rememberCheckbox.checked = !rememberCheckbox.checked;
        if (rememberCheckbox.checked) {
            customCheckbox.style.background = 'var(--primary-orange)';
            customCheckbox.querySelector('i').style.display = 'block';
        } else {
            customCheckbox.style.background = 'rgba(255, 255, 255, 0.1)';
            customCheckbox.querySelector('i').style.display = 'none';
        }
    });

    // 3. Loading State en el botón al enviar formulario
    const loginForm = document.getElementById('adminLoginForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnIcon = document.getElementById('btnIcon');

    loginForm.addEventListener('submit', () => {
        submitBtn.disabled = true;
        btnIcon.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i>';
        btnText.textContent = 'Iniciando sesión...';
    });
</script>

</body>
</html>
