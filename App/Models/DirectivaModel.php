<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class DirectivaModel
{
    private $tabla = "`directiva`";
    private $alias = "dr"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_directiva";
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }
 
    public function getAll($tipo)
    {
        
        $stmt = $this->db->prepare("SELECT dr.id_directiva as id , tp.titulo as nombre
        FROM {$this->tabla} {$this->alias}
        INNER JOIN status st ON st.id_status = dr.status
        INNER JOIN tipo_directiva tp ON tp.id_tipo_directiva = dr.id_tipo_directiva
        WHERE st.titulo = :TIPO;");
        $stmt->bindParam(':TIPO', $tipo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
   
    // Método para buscar un registro por su dui
    public function findByDui($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tabla} {$this->alias} WHERE usuario = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
    // public function createUsuario(array $data)
    // {
    //      $INSTANCIA= new Encryptar($_ENV["JWT_SECRET_KEY"]);
    //      $passwordEncry=$INSTANCIA->decryptItem($data["contraseña"]);

    //     $stmt = $this->db->prepare("INSERT INTO {$this->tabla} (usuario,`password`,email,tipo_usuario,`status`) 
    //                                 VALUES (:USUARIO,:PASSWOR,:EMAIL,:TIPO,:STATU)");
    //     $stmt->bindValue(":USUARIO", $data["usuario"]);
    //     $stmt->bindValue(":PASSWOR", $passwordEncry);
    //     $stmt->bindValue(":EMAIL", $data["email"]);
    //     $stmt->bindValue(":TIPO", 3);
    //     $stmt->bindValue(":STATU",1);
    //     return $stmt->execute();

    // }

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
