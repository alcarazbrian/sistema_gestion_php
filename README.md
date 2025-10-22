# 🏢 Genesys - Sistema de Gestión Integral

Sistema de gestión empresarial desarrollado para control de productos de mascotas y administración de empleados, implementado con arquitectura MVC y tecnologías web modernas como trabajo académico para la materia Programación de Sistemas.

## 📚 Información Académica

**Trabajo Práctico - Materia: Programación de Sistemas**

Sistema completo desarrollado con metodologías ágiles y mejores prácticas de desarrollo web.

## 🌟 Características Principales

### Módulos del Sistema

| Módulo | Funcionalidades | Estado |
|--------|----------------|--------|
| 📦 Gestión de Productos | CRUD completo, Control de inventario, Entrada/Salida | ✅ Completo |
| 👥 Gestión de Empleados | CRUD completo, Estados (Activo/Inactivo), Roles | ✅ Completo |
| 📊 Dashboard Gerencial | Métricas en tiempo real, Estadísticas del negocio | ✅ Completo |
| 🔐 Sistema de Roles | Empleado vs Gerente, Control de acceso | ✅ Completo |
| 📤 Exportación de Datos | PDF, Excel, Reportes personalizados | ✅ Completo |
| 👀 Gestión de Estados | Empleados Activos/Inactivos con fechas | ✅ Completo |

## 🛠 Stack Tecnológico

### Backend & Base de Datos

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| PHP | 7.4+ | Lenguaje del servidor con POO |
| MySQL | 5.7+ | Base de datos relacional |
| PDO | - | Abstraction para base de datos |
| Apache | 2.4+ | Servidor web |

### Frontend & UI/UX

| Tecnología | Versión | Propósito |
|------------|---------|-----------|
| Bootstrap 5 | 5.3+ | Framework CSS responsive |
| DataTables | 1.13+ | Tablas interactivas |
| JavaScript | ES6+ | Interactividad del cliente |
| HTML5 | - | Estructura semántica |
| CSS3 | - | Estilos y diseño |
| Toast Notifications | - | Sistema de alertas y feedback |

## 🚀 Instalación y Configuración

### Prerrequisitos

* ✅ XAMPP instalado (Apache + MySQL + PHP)
* ✅ Navegador web moderno

### Paso a Paso: Configuración con XAMPP

#### 1. Descargar e Instalar XAMPP
```bash
# Descargar desde: https://www.apachefriends.org/
```

#### 2. Descargar el Proyecto

* Descargar el ZIP del repositorio
* Extraer en la carpeta `htdocs` de XAMPP

#### 3. Ubicar el Proyecto
```text
# Mover la carpeta del proyecto a:
C:\xampp\htdocs\genesys\
```

#### 4. Iniciar Servicios XAMPP

* Abrir XAMPP Control Panel
* Iniciar Apache y MySQL
* Verificar estado VERDE en ambos servicios

#### 5. Importar Base de Datos ⚠️ IMPORTANTE

1. Abrir: `http://localhost/phpmyadmin`
2. Ir a pestaña "Importar"
3. Seleccionar: `sistema_gestion.sql` (en la raíz del proyecto)
4. Clic en "Continuar"

✅ La base de datos se crea automáticamente con todas las tablas

#### 6. Configurar Archivos de Conexión

**📄 config.php (en raíz del proyecto)**
```php
<?php
// Configuración general del sistema
define('DB_HOST', 'localhost');
define('DB_NAME', 'sistema_gestion');
define('DB_USER', 'root');
define('DB_PASS', '');  // Vacío por defecto XAMPP
?>
```

**📁 config/database.php**
```php
<?php
require_once __DIR__ . '/../config.php';

$host = DB_HOST;
$dbname = DB_NAME;
$username = DB_USER;
$password = DB_PASS;

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
```

#### 7. Acceder al Sistema
```text
http://localhost/genesys/
```

## 🧪 Credenciales de Prueba

Para probar el sistema con permisos de **Gerente**, utiliza estas credenciales:

| Usuario | Contraseña |
|---------|------------|
| `diegote@email.com` | `diegote` |

> 💡 **Nota:** Este usuario tiene acceso completo al dashboard gerencial y todas las funcionalidades del sistema.


## 👥 Sistema de Roles

### 🏢 Gerente

* Gestión completa de empleados
* Dashboard con métricas
* Control de productos
* Exportación de reportes

### 👤 Empleado

* Gestión de productos
* Visualización de inventario
* Exportación de datos

## 🎨 Capturas del Sistema

![Captura 1](public/img/1.png)
![Captura 2](public/img/2.png)
![Captura 3](public/img/3.png)
![Captura 4](public/img/4.png)
![Captura 5](public/img/5.png)

## 🎓 Objetivos Académicos

* ✅ Arquitectura MVC
* ✅ Programación Orientada a Objetos
* ✅ MySQL y PDO
* ✅ Bootstrap 5 y DataTables
* ✅ Control de Versiones con Git
* ✅ Metodología Kanban

## 🐛 Solución de Problemas

### Error de Conexión a Base de Datos
* Verificar que MySQL esté ejecutándose en XAMPP
* Revisar credenciales en `config.php`
* Asegurar que la base de datos fue importada correctamente

### Página en Blanco
* Verificar que Apache esté corriendo
* Revisar logs de error en `C:\xampp\apache\logs\error.log`
* Comprobar permisos de archivos

### Tablas No Se Muestran
* Limpiar caché del navegador
* Verificar consola del navegador (F12) para errores JavaScript
* Comprobar que las rutas de DataTables sean correctas

⭐ **Si este proyecto te fue útil, no olvides darle una estrella!**