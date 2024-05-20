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

    // public function salidaDinero($tipo_entrada)
    // {
    //     // SQL del procedimiento almacenado con placeholders para los parámetros
    //     $columns = implode(", ", array_keys($tipo_entrada));
    //     $values = ":" . implode(", :", array_keys($tipo_entrada));
      
    // // Preparar la llamada al procedimiento almacenado
    // $stmt = $this->db->prepare("CALL VerificarYRegistrarTransaccionSalida({$columns} )");

    // // Vincular dinámicamente los parámetros usando un bucle foreach
    // foreach ($tipo_entrada as $param => $value) {
    //     $stmt->bindParam(':'.$param, $tipo_entrada[$param]);
    // }

    // // Ejecutar la llamada al procedimiento almacenado
    // $stmt->execute();
    // // Obtener el resultado de la operación
    // $result = $this->db->query("SELECT @transaccion_exitosa AS transaccionExitosa")->fetch(PDO::FETCH_ASSOC);

    // // Devolver el resultado
    // return $result;
    // }


    public function salidaDinero($tipo_entrada)
{
    try {
        // Iniciar la transacción
        $this->db->beginTransaction();

        // Calcular el capital disponible
        $query = "SELECT 
            (SUM(CASE WHEN id_tipo_transacion = 1 THEN monto ELSE 0 END) - 
            SUM(CASE WHEN id_tipo_transacion = 2 THEN monto ELSE 0 END)) AS capital_disponible
        FROM transacciones
        WHERE id_tipo_entrada = :id_tipo_entrada";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_tipo_entrada', $tipo_entrada['p_id_tipo_entrada']);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $capital_disponible = $result['capital_disponible'];

        // Verificar si la transacción de salida es posible
        if ($capital_disponible >= $tipo_entrada['monto']) {
            // Preparar la inserción de la nueva transacción
            $insertSQL = "INSERT INTO transacciones (monto, comentario, id_realizada_por, id_tipo_transacion, id_tipo_entrada, id_directiva, usuario_creacion) 
            VALUES (:monto, :comentario, :id_realizada_por, :id_tipo_transacion, :id_tipo_entrada, :id_directiva, :usuario_creacion)";
            $insertStmt = $this->db->prepare($insertSQL);
            $insertStmt->execute($tipo_entrada);

            // Verificar si la inserción fue exitosa
            if ($insertStmt->rowCount() > 0) {
                $this->db->commit();
                return ['transaccionExitosa' => true];
            } else {
                $this->db->rollBack();
                return ['transaccionExitosa' => false];
            }
        } else {
            $this->db->rollBack();
            return ['transaccionExitosa' => false];
        }
    } catch (Exception $e) {
        // En caso de error, hacer rollback y manejar la excepción
        $this->db->rollBack();
        throw $e;
    }
}


//     public function salidaDinero($tipo_entrada)
// {
//     // Asumir que conocemos las claves y que corresponden a los parámetros del procedimiento
//     $placeholders = implode(", ", array_map(function($key) {
//         return ":" . $key;
//     }, array_keys($tipo_entrada)));

//     // SQL del procedimiento almacenado con placeholders dinámicos
//     $sql = "CALL VerificarYRegistrarTransaccionSalida($placeholders, @transaccion_exitosa)";

//     // Preparar la llamada al procedimiento almacenado
//     $stmt = $this->db->prepare($sql);

//     // Vincular dinámicamente los parámetros usando un bucle foreach
//     foreach ($tipo_entrada as $param => $value) {
//         $stmt->bindParam(':'.$param, $tipo_entrada[$param]);
//     }

//     // Ejecutar la llamada al procedimiento almacenado
//     $stmt->execute();

//     // Obtener el resultado de la operación
//     $result = $this->db->query("SELECT @transaccion_exitosa AS transaccionExitosa")->fetch(PDO::FETCH_ASSOC);

//     // Devolver el resultado
//     return $result;
// }

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
