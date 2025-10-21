<?php
class AuthModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function login($email, $password) {
        // Buscar usuario por email
        $stmt = $this->pdo->prepare("
            SELECT e.id, e.email, e.contraseña, e.rol_id, e.nombre, e.apellido, e.estado, r.Nombre as rol_nombre
            FROM empleados e
            INNER JOIN roles r ON e.rol_id = r.ID
            WHERE e.email = ?
        ");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verificar contraseña y estado activo
            if (password_verify($password, $user['contraseña']) && $user['estado'] === 'activo') {
                // Actualizar último acceso
                $updateStmt = $this->pdo->prepare("UPDATE empleados SET ultimo_acceso = NOW() WHERE id = ?");
                $updateStmt->execute([$user['id']]);
                return $user;
            }
        }
        return false;
    }

    // Método para verificar si el usuario existe (para el script de hash)
    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT id, email, contraseña FROM empleados WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>