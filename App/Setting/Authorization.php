<?php


namespace App\Setting;

use PDO;

class Authorization
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }

    public function hasPagePermission($menuId)
    {
        // Aquí iría tu lógica para verificar si un usuario tiene acceso a un ítem específico del menú.
        // Por ejemplo, puedes consultar la base de datos para buscar permisos.
        $stmt = $this->db->prepare("SELECT tipo_permiso FROM permisos_usuario WHERE id_usuario = :userId AND id_menu = :menuId");
        $stmt->execute([':userId' => $_SESSION["datos"][0]["id"], ':menuId' => $menuId]);
        $permission = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$permission || $permission['tipo_permiso'] === 'ninguno') {
            return false;
        }

        return true;
    }
}
