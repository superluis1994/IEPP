<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class EntradasModel
{
    private $tabla = "`tipo_de_entrada`";
    private $alias = "tdent"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_tipo_entrada";
    private $db;
    /** CAMPOS DE LA TABLA */
    private $titulo="titulo";
    private $status="status";
    private $posicion="posicion";

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }
 
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT {$this->primaryKey} as id, {$this->titulo} as entrada
        FROM {$this->tabla}
        WHERE {$this->status} = 1 ORDER BY {$this->posicion} ASC");
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
