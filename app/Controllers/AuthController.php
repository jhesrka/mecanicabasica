<?php
namespace App\Controllers;

use App\Models\Usuario;
use App\Models\Configuracion;

class AuthController extends BaseController {

    // Mostrar el formulario de Login
    public function login() {
        // Si ya está logueado, mandar al dashboard
        if (isset($_SESSION['user_id'])) {
            header('Location: /');
            exit;
        }

        // Obtener configuración para logo y nombre de la empresa
        $configModel = new Configuracion();
        $sistema = $configModel->obtenerConfiguracion();

        // Generar token CSRF si no existe
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $csrf_token = $_SESSION['csrf_token'];
        $flash_error = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_error']);
        
        // Cargamos la vista de login
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    // Procesar el formulario
    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validar token CSRF
            $postToken = $_POST['csrf_token'] ?? '';
            if (empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $postToken)) {
                $_SESSION['flash_error'] = 'Sesión inválida o expirada. Intenta nuevamente.';
                header('Location: /login');
                exit;
            }

            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['flash_error'] = 'Por favor completa todos los campos.';
                header('Location: /login');
                exit;
            }

            $userModel = new Usuario();
            $usuario = $userModel->getByEmail($email);

            if ($usuario) {
                $check = false;
                if (password_verify($password, $usuario->password)) {
                    $check = true;
                } elseif ($password === $usuario->password) {
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $this->db->prepare("UPDATE usuarios SET password = ? WHERE id = ?")->execute([$newHash, $usuario->id]);
                    $check = true;
                }

                if ($check) {
                    // Prevenir Session Fixation
                    session_regenerate_id(true);

                    // Reemplazar token CSRF para la sesión autenticada
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));

                    $_SESSION['user_id'] = $usuario->id;
                    $_SESSION['user_name'] = $usuario->nombre;
                    $_SESSION['user_role'] = $usuario->rol;
                    
                    header('Location: /');
                    exit;
                }
            }

            // Si falla la autenticación
            $_SESSION['flash_error'] = 'Usuario o contraseña incorrectos.';
            header('Location: /login');
            exit;
        }
    }

    // Cerrar Sesión
    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
