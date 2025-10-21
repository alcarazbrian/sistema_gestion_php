<?php
// Obtener la página solicitada
$page = $_GET['page'] ?? 'login';

// Incluir el middleware de autenticación
require_once 'helpers/Auth.php';

// Router principal
switch ($page) {

    case 'gerente':
        // SOLO gerentes (rol 1)
        Auth::checkRole(1);

        require_once 'config.php';
        require_once 'database.php';
        require_once 'models/empleado.model.php';

        $empleadoModel = new EmpleadoModel($pdo);
        $empleados = $empleadoModel->getAll();

        // CONTAR TODOS LOS EMPLEADOS
        $stmt = $pdo->query("SELECT COUNT(*) as total_empleados FROM empleados");
        $total_empleados = $stmt->fetch()['total_empleados'];

        // CONTAR PRODUCTOS TOTALES
        $stmt = $pdo->query("SELECT COUNT(*) as total_productos FROM productos");
        $total_productos = $stmt->fetch()['total_productos'];

        // CONTAR EMPLEADOS ACTIVOS
        $stmt = $pdo->query("SELECT COUNT(*) as total_empleados_activos FROM empleados WHERE Estado = 'activo'");
        $total_empleados_activos = $stmt->fetch()['total_empleados_activos'];

        // CONTAR EMPLEADOS INACTIVOS
        $stmt = $pdo->query("SELECT COUNT(*) as total_empleados_inactivos FROM empleados WHERE estado = 'inactivo'");
        $total_empleados_inactivos = $stmt->fetch()['total_empleados_inactivos'];

        // AJAX stats
        if (isset($_GET['ajax']) && $_GET['ajax'] === 'stats') {
            header('Content-Type: application/json');
            echo json_encode([
                'empleados' => $total_empleados,
                'activos' => $total_empleados_activos,
                'inactivos' => $total_empleados_inactivos,
                'productos' => $total_productos
            ]);
            exit;
        }

        // Clasificar empleados
        $empleados_activos = array_filter($empleados, function ($e) {
            return isset($e['estado']) && strtolower($e['estado']) === 'activo';
        });

        $empleados_inactivos = array_filter($empleados, function ($e) {
            return isset($e['estado']) && strtolower($e['estado']) === 'inactivo';
        });

        include 'views/gerente.view.php';
        break;

    case 'gestion_empleados':
        // SOLO gerentes (rol 1)
        Auth::checkRole(1);

        require_once 'database.php';
        require_once 'controllers/empleado.controller.php';

        $controller = new EmpleadoController();
        $controller->handleRequest();
        break;

    case 'productos':
        // Cualquier usuario logueado (gerente o empleado)
        Auth::checkAuth();

        require_once 'config.php';
        require_once 'database.php';
        require_once 'controllers/product.controller.php';

        $controller = new ProductoController();
        $controller->handleRequest();
        break;

    case 'login':
        // Si ya está logueado, redirigir según rol
        if (Auth::isLoggedIn()) {
            if ($_SESSION['user_rol_id'] == 1) {
                header('Location: index.php?page=gerente');
            } else {
                header('Location: index.php?page=productos');
            }
            exit;
        }

        // Usar el AuthController para procesar login
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario']) && isset($_POST['password'])) {
            require_once 'controllers/Auth.controller.php';
            $authController = new AuthController();
            $authController->login();
            exit;
        }

        // Mostrar formulario de login
        include 'views/login.view.php';
        break;

    case 'logout':
        // Usar el AuthController para logout
        require_once 'controllers/Auth.controller.php';
        $authController = new AuthController();
        $authController->logout();
        break;

    default:
        header('Location: index.php?page=login');
        exit;
}
?>
