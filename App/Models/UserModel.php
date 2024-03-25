<?php

namespace App\Models;
use App\Setting\Conexion;
use PDO;

class UserModel
{
    private $tabla = "congregacion";
    private $alias = "cg"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_congregacion";
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
        // Asegúrate de que $this->db no es null antes de continuar
    }

    // METODO PARA VALIDAR LOS DATOS DEL DIRECTIVO Y RETORNAR LOS DATOS
    public function validateUser(array $data)
    {   
        // $camposArray = array_values($data);
        // $campos = implode(", ", $camposArray);
        $stmt = $this->db->prepare("SELECT cg.id_hermano as id, cg.usuario as dui, cg.password as passwor, dtp.nombre, dtp.apellido,
                                           drt.year, td.titulo
                                    FROM {$this->tabla} {$this->alias}
                                    INNER JOIN datos_personales dtp ON dtp.id_congregacion = cg.id_hermano
                                    INNER JOIN directivos dr ON dr.id_congregacion  = cg.id_hermano
                                    INNER JOIN directiva drt ON drt.id_directiva = dr.id_directiva
                                    INNER JOIN tipo_directiva  td ON td.id_tipo_directiva = drt.id_tipo_directiva
                                    WHERE cg.usuario = :USUARIO;");
                                    $stmt->bindParam(":USUARIO", $data["usuario"], PDO::PARAM_STR);
                                    $stmt->execute();
                                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabla} {$this->alias}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar un registro por su clave primaria
    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabla} {$this->alias} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para insertar un nuevo registro
    public function create(array $data)
    {
        // Asume que $data es un array asociativo con las columnas y sus valores
        $columns = implode(", ", array_keys($data));
        $values = ":" . implode(", :", array_keys($data));

        $stmt = $this->db->prepare("INSERT INTO {$this->tabla} ({$columns}) VALUES ({$values})");
        
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    // Método para actualizar un registro
    public function update($id, array $data)
    {
        $setPart = [];
        foreach ($data as $key => $value) {
            $setPart[] = "{$key} = :{$key}";
        }
        $setPart = implode(", ", $setPart);

        $stmt = $this->db->prepare("UPDATE {$this->tabla} SET {$setPart} WHERE {$this->primaryKey} = :id");

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    // Método para eliminar un registro
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->tabla} WHERE {$this->primaryKey} = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
