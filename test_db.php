<!-- ESTE ARCHIVO LO USO PARA VERIFICAR QUE LA BASE DE DATOS ESTE BIEN CONECTADA -->
<!-- ACA DIRECTAMENTE ME ABRE UNA RESPUESTA EN EL NAVEGADOR -->
<!-- PARA EJECUTAR Y CHEQUEAR ESTO INGRESA A: http://localhost/tu-carpeta/test_db.php EN EL NAVEGADOR -->
<!-- OBVIAMENTE HAY QUE TENER LAS CONEXCIONES DE XAMPP Y YA LA BASE DE DATOS -->

<?php
require_once 'database.php';

try {
    // HACEMOS LA CONSULTA
    $stmt = $pdo->query("SELECT * FROM productos");

    // TRAEMOS TODOS LOS REGISTROS COMO ARRAYS ASOCIATIVOS
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // MOSTRAMOS EL RESULTADO EN PANTALLA
    echo "<pre>";
    print_r($productos);
    echo "</pre>";

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}