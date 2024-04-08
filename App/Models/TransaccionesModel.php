<?php

namespace App\Models;

use App\Setting\Conexion;

use PDO;

class TransaccionesModel
{
    private $tabla = "transacciones";
    private $alias = "trs"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_transacciones";
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }

    // METODO PARA VALIDAR LOS DATOS DEL DIRECTIVO Y RETORNAR LOS DATOS

    public function totales()
    {
        $stmt = $this->db->prepare("SELECT tde.titulo, 
                                    CASE 
                                        WHEN (COALESCE(SUM(CASE WHEN tt.titulo = 'INGRESO' AND YEAR(trs.fecha_transacion) = YEAR(CURRENT_DATE) THEN trs.monto ELSE 0 END), 0) -
                                            COALESCE(SUM(CASE WHEN tt.titulo = 'RETIRO' AND YEAR(trs.fecha_transacion) = YEAR(CURRENT_DATE) THEN trs.monto ELSE 0 END), 0)) = 0 THEN 'Sin dinero'
                                        ELSE CAST((COALESCE(SUM(CASE WHEN tt.titulo = 'INGRESO' AND YEAR(trs.fecha_transacion) = YEAR(CURRENT_DATE) THEN trs.monto ELSE 0 END), 0) -
                                                COALESCE(SUM(CASE WHEN tt.titulo = 'RETIRO' AND YEAR(trs.fecha_transacion) = YEAR(CURRENT_DATE) THEN trs.monto ELSE 0 END), 0)) AS CHAR)
                                    END AS balance_neto
                                FROM tipo_de_entrada tde
                                    LEFT JOIN transacciones trs ON tde.id_tipo_entrada = trs.id_tipo_entrada AND YEAR(trs.fecha_transacion) = YEAR(CURRENT_DATE)
                                    LEFT JOIN tipo_transacion tt ON tt.id_tipo_transacion = trs.id_tipo_transacion
                                GROUP BY tde.titulo ORDER BY tde.posicion ASC;");
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
