<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Gestión - Genesys</title>
    <!-- BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- NOTIFICACIONES TOAST -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.3/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.5/css/buttons.bootstrap5.css">

    <!-- TUS STYLES ORIGINALES + NUEVOS -->
    <style>
        /* TUS STYLES ORIGINALES */
        /* Quita la imagen que viene por defecto*/
        #toast-container>.toast {
            background-image: none !important;
        }

        /* Quitar espaciado del icono */
        #toast-container .toast {
            padding: 15px 15px 15px 15px !important;
        }

        /* Ordena el datatable de Datatables.net - Se lo ponen y queda feo */
        .row>* {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* Mediaqueries */
        /* Sobrescribe la fila de controles en pantallas pequeñas */
        @media (max-width: 767px) {
            div.dt-container>div.row {
                justify-content: center !important;
                /* centra todos los elementos */
                flex-wrap: wrap;
                /* para que se ajusten si hay varios elementos */
            }

            div.dt-container .dataTables_filter {
                text-align: center !important;
                /* centra el input */
                width: 100%;
                /* opcional, que ocupe todo el ancho */
            }
        }

        /* NUEVOS STYLES PARA EL HEADER */
        .navbar-brand { color: white !important; }
        .dropdown-menu { min-width: 200px; }
        .user-dropdown { color: rgba(255,255,255,0.9) !important; }
        .user-dropdown:hover { color: white !important; }
    </style>
</head>
<body>
<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay usuario logueado
$isLoggedIn = isset($_SESSION['user_id']) && isset($_SESSION['user_rol_id']);
$userNombre = $isLoggedIn ? ($_SESSION['user_nombre'] . ' ' . $_SESSION['user_apellido']) : '';
$userRolId = $isLoggedIn ? $_SESSION['user_rol_id'] : null;
$userRolNombre = $isLoggedIn ? ($userRolId == 1 ? 'Gerente' : 'Empleado') : '';

// Sanitizar salida
$userNombre = htmlspecialchars($userNombre, ENT_QUOTES, 'UTF-8');
$userRolNombre = htmlspecialchars($userRolNombre, ENT_QUOTES, 'UTF-8');
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold fs-3" href="index.php?page=<?php echo $isLoggedIn ? ($userRolId == 1 ? 'gerente' : 'productos') : 'login'; ?>">
            <i class="bi bi-building me-2"></i>Genesys
        </a>

        <!-- Botón móvil -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del navbar -->
        <div class="collapse navbar-collapse" id="navbarMain">
            
            <!-- Menú central - SOLO si está logueado -->
            <?php if ($isLoggedIn): ?>
            <ul class="navbar-nav me-auto">
                <?php if ($userRolId == 1): ?>
                    <!-- MENÚ GERENTE -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=gerente">
                            <i class="bi bi-speedometer2 me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=gestion_empleados">
                            <i class="bi bi-people me-1"></i>Empleados
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=productos">
                            <i class="bi bi-box me-1"></i>Productos
                        </a>
                    </li>
                <?php else: ?>
                    <!-- MENÚ EMPLEADO -->
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=productos">
                            <i class="bi bi-box me-1"></i>Productos
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>

            <!-- Menú derecho -->
            <ul class="navbar-nav ms-auto">
                <?php if ($isLoggedIn): ?>
                    <!-- DROPDOWN USUARIO -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle user-dropdown d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2"></i>
                            <div>
                                <strong><?php echo $userNombre; ?></strong>
                                <small class="d-block opacity-75"><?php echo $userRolNombre; ?></small>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- Gerente: Todas las vistas -->
                            <?php if ($userRolId == 1): ?>
                                <li><a class="dropdown-item" href="index.php?page=gerente"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                <li><a class="dropdown-item" href="index.php?page=gestion_empleados"><i class="bi bi-people me-2"></i>Gestión Empleados</a></li>
                                <li><a class="dropdown-item" href="index.php?page=productos"><i class="bi bi-box me-2"></i>Gestión Productos</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <?php else: ?>
                                <!-- Empleado: Solo productos -->
                                <li><a class="dropdown-item" href="index.php?page=productos"><i class="bi bi-box me-2"></i>Gestión Productos</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <?php endif; ?>
                            
                            <!-- Logout para ambos -->
                            <li><a class="dropdown-item text-danger" href="index.php?page=logout"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- No logueado -->
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light" href="index.php?page=login">
                            <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesión
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">