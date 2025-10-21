<?php
class Auth {
    public static function checkAuth() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_rol_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
    }

    public static function checkRole($requiredRoleId) {
        self::checkAuth();
        if ($_SESSION['user_rol_id'] != $requiredRoleId) {
            if ($_SESSION['user_rol_id'] == 2) {
                header('Location: index.php?page=productos');
            } else {
                header('Location: index.php?page=gerente');
            }
            exit;
        }
    }

    public static function checkEmployeeAccess() {
        self::checkAuth();
        if ($_SESSION['user_rol_id'] == 2) {
            $currentPage = $_GET['page'] ?? '';
            if ($currentPage !== 'productos') {
                header('Location: index.php?page=productos');
                exit;
            }
        }
    }

    public static function isLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']) && isset($_SESSION['user_rol_id']);
    }
}
?>