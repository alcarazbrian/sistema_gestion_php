<?php

// Obtener la página solicitada
$page = $_GET['page'] ?? 'login';

// Router principal
switch($page) {

    case 'gerente':
        // Verificar que sea gerente (opcional)
        // if (!isset($_SESSION['user_id'])) {
        //     header('Location: index.php?page=login');
        //     exit;
        // }

        require_once 'config.php';
        require_once 'database.php';
        // require_once 'controllers/empleado.controller.php';
        // require_once 'models/empleado.model.php';

        // $controller = new EmpleadoController();
        // $controller->handleRequest(); // Procesa las acciones del formulario

        // $empleadoModel = new EmpleadoModel($pdo);
        // $empleados = $empleadoModel->getAll();

        // CONTAR LOS PRODUYCTOS TOTALES QUE TENGO ACTUALMETE
        $stmt = $pdo->query("SELECT COUNT(*) as total_productos FROM productos");
        $total_productos = $stmt->fetch()['total_productos'];

        // CONTAR EMPLEADOS ACTIVOS CON ACCESO AL SISTEMA
        $stmt = $pdo->query("SELECT COUNT(*) as total_empleados_activos FROM empleados WHERE Estado = 'activo'");
        $total_empleados_activos = $stmt->fetch()['total_empleados_activos'];

        // CONTAR EMPLEADOS INACTIVOS SIN ACCESO AL SISTEMA POR EL MOTIVO QUE SEA
        $stmt = $pdo->query("SELECT COUNT(*) as total_empleados_inactivos FROM empleados WHERE estado = 'inactivo'");
        $total_empleados_inactivos = $stmt->fetch()['total_empleados_inactivos'];

        //include 'views/layouts/header.php';
        include 'views/gerente.view.php';
        //include 'views/layouts/footer.php';
        break;

    case 'gestion_empleados':
        // Cargar y ejecutar controlador de empleados
        require_once 'database.php';
        require_once 'controllers/empleado.controller.php';

        $controller = new EmpleadoController();
        $controller->handleRequest(); // El controlador maneja su propia lógica
        break;

    case 'productos':
        // Cargar y ejecutar controlador de productos
        require_once 'config.php';
        require_once 'database.php';
        require_once 'controllers/product.controller.php';

        $controller = new ProductoController();
        $controller->handleRequest(); // El controlador maneja su propia lógica
        break;

    case 'login':
        // Procesar formulario de login si viene por POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario']) && isset($_POST['password'])) {
            $usuario = trim($_POST['usuario']);
            $password = $_POST['password'];

            // Credenciales de prueba
            if ($usuario === 'admin' && $password === '123456') {
                $_SESSION['user_id'] = 1;
                $_SESSION['usuario'] = $usuario;
                $_SESSION['success_message'] = '¡Bienvenido al sistema Genesys!';
                header('Location: index.php?page=productos');
                exit;
            } else {
                $_SESSION['error_message'] = 'Usuario o contraseña incorrectos';
                header('Location: index.php?page=login');
                exit;
            }
        }

        // Si ya está logueado, ir a productos
        if (isset($_SESSION['user_id'])) {
            header('Location: index.php?page=productos');
            exit;
        }

        // Mostrar formulario de login
        //include 'views/layouts/header.php';
        include 'views/login.view.php';
        //include 'views/layouts/footer.php';
        break;

    case 'logout':
        // Cerrar sesión
        session_destroy();
        session_start();
        $_SESSION['success_message'] = 'Sesión cerrada correctamente';
        header('Location: index.php?page=login');
        exit;
        break;

    default:
        // Por defecto, ir a productos
        header('Location: index.php?page=login');
        exit;
}
?>