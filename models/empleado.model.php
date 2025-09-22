<?php
require_once __DIR__ . '../../config.php';

class EmpleadoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; // RECIBE LA CONEXION PDO DESDE AFUERA
    }

    // OBTENEMOS TODO LOS EMPLEADOS
    public function getAll() {
        // $stmt = $this->pdo->query("SELECT * FROM productos ORDER BY ID DESC");
        $stmt = $this->pdo->query("SELECT ID as id, DNI as dni, Nombre as nombre, Apellido as apellido, Email as email, Contraseña as contraseña, Rol_ID as rol_id, Estado as estado, Sesion_activa as sesion_activa, Ultimo_acceso as ultimo_acceso, Creado as creacion, Actualizado as actualizado FROM empleados ORDER BY id ASC");
        return $stmt->fetchAll();
    }

    // OBETENEMOS UN PRODUCTO POR ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT ID as id, DNI as dni, Nombre as nombre, Apellido as apellido, Email as email, Contraseña as contraseña, Rol_ID as rol_id, Estado as estado, Sesion_activa as sesion_activa, Ultimo_acceso as ultimo_acceso FROM empleados WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // CREAMOS NUEVO EMPLEADO
    public function create($dni, $nombre, $apellido, $email, $contraseña, $rol_id, $estado) {
        $stmt = $this->pdo->prepare("INSERT INTO empleados (DNI, Nombre, Apellido, Email, Contraseña, Rol_ID, Estado) VALUES (?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$dni, $nombre, $apellido, $email, $contraseña, $rol_id, $estado]);
    }

    // ACTUALIZAMOS DATOS DEL EMPLEADO
    public function update($id, $dni, $nombre, $apellido, $email, $contraseña, $rol_id, $estado) {
        $stmt = $this->pdo->prepare("UPDATE empleados SET DNI=?, Nombre=?, Apellido=?, Email=?, Contraseña=?, Rol_ID=?, Estado=? WHERE ID=?");
        return $stmt->execute([$dni, $nombre, $apellido, $email, $contraseña, $rol_id, $estado, $id]);
    }

    // ELIMINAMOS PRODUCTO
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM empleados WHERE id=?");
        return $stmt->execute([$id]);
    }
}

?>