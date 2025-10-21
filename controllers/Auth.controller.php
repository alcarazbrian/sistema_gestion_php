<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../models/Auth.model.php';

class AuthController {
    private $model;

    public function __construct() {
        global $pdo;
        $this->model = new AuthModel($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario']) && isset($_POST['password'])) {
            $email = filter_var($_POST['usuario'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['password'];

            $user = $this->model->login($email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_rol_id'] = $user['rol_id'];
                $_SESSION['user_nombre'] = $user['nombre'];
                $_SESSION['user_apellido'] = $user['apellido'];
                $_SESSION['user_rol_nombre'] = $user['rol_nombre'];

                // Redirigir según rol
                if ($user['rol_id'] == 1) { // Gerente
                    header('Location: index.php?page=gerente');
                } else { // Empleado
                    header('Location: index.php?page=productos');
                }
                exit;
            } else {
                $_SESSION['error_message'] = 'Credenciales incorrectas o usuario inactivo';
                header('Location: index.php?page=login');
                exit;
            }
        }
    }

    public function logout() {
        // Destruir sesión completamente
        session_destroy();

        // Iniciar nueva sesión para mensaje
        session_start();
        $_SESSION['success_message'] = 'Sesión cerrada correctamente';

        header('Location: index.php?page=login');
        exit;
    }
}
?>