<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
use PDO;

class TalentoModel
{
    private $tabla = "`transacciones`";
    private $alias = "tr"; // Alias de la tabla referente al modelo
    private $primaryKey = "id_transacciones";
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion_();
    }
 
    public function getAll($id,$tipo,$offset=NULL,$limited)
    {
        
        $stmt = $this->db->prepare("SELECT tr.id_transacciones as id, CONCAT(SUBSTRING_INDEX(dtp.nombre, ' ', 1), ' ', 
                                            SUBSTRING_INDEX(SUBSTRING_INDEX(dtp.apellido, ' ', -1), ' ', 1)) as realizado,
                                            tr.monto as cantidad, tr.fecha_creacion as fecha 
                                    FROM {$this->tabla} {$this->alias}
                                    INNER JOIN congregacion cg ON cg.id_hermano = tr.id_realizada_por
                                    INNER JOIN datos_personales dtp ON dtp.id_congregacion = cg.id_hermano
                                    INNER JOIN tipo_transacion tt ON tt.id_tipo_transacion = tr.id_tipo_transacion
                                    INNER JOIN tipo_de_entrada tde ON tde.id_tipo_entrada = tr.id_tipo_entrada
                                    INNER JOIN directiva dr ON dr.id_directiva = tr.id_directiva
                                    INNER JOIN tipo_directiva tdr ON tdr.id_tipo_directiva = dr.id_tipo_directiva
                                    WHERE dr.id_directiva = :ID AND tr.id_tipo_transacion = :TIPO
                                    LIMIT $limited");
        $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
        $stmt->bindParam(':TIPO', $tipo, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCount($id,$tipo)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) AS total 
                                    FROM {$this->tabla} {$this->alias}
                                     INNER JOIN tipo_transacion tt ON tt.id_tipo_transacion = tr.id_tipo_transacion
                                     INNER JOIN directiva dr ON dr.id_directiva = tr.id_directiva
                                     WHERE tr.id_tipo_transacion =:TIPO AND dr.id_directiva = :ID");
        $stmt->bindParam(':ID', $id, PDO::PARAM_INT);
        $stmt->bindParam(':TIPO', $tipo, PDO::PARAM_INT);
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

    public function createUsuario(array $data)
    {
        // Iniciar la transacción
        $this->db->beginTransaction();
        
        try {
            $INSTANCIA= new Encryptar($_ENV["JWT_SECRET_KEY"]);
            $passwordEncry = $INSTANCIA->encrypt($data["contraseña"]);
    
            $stmt = $this->db->prepare("INSERT INTO {$this->tabla} (usuario,`password`,email,tipo_usuario,`status`) 
                                        VALUES (:USUARIO,:PASSWOR,:EMAIL,:TIPO,:STATU)");
            $stmt->bindValue(":USUARIO", $data["dui"]);
            $stmt->bindValue(":PASSWOR", $passwordEncry);
            $stmt->bindValue(":EMAIL", $data["email"]);
            $stmt->bindValue(":TIPO", 3);
            $stmt->bindValue(":STATU", 1);
            
            // Ejecutar la consulta de inserción
            $stmt->execute();
    
            // Obtener el ID generado por la inserción
            $insertedId = $this->db->lastInsertId();
            
            // Aquí puedes usar $insertedId para hacer otra inserción o cualquier operación necesaria
            $anotherStmt = $this->db->prepare("INSERT INTO datos_personales (nombre, apellido, telefono, id_congregacion) VALUES (:NOMBRE, :APELLIDOS, :TELEFONO, :IDCONGREGACION)");
            $anotherStmt->bindValue(":NOMBRE", strtoupper($data["nombre"]));
            $anotherStmt->bindValue(":APELLIDOS", strtoupper($data["apellidos"]));
            $anotherStmt->bindValue(":TELEFONO", "+503 ".$data["telefono"]);
            $anotherStmt->bindValue(":IDCONGREGACION", $insertedId); // Asegúrate de que esta es la columna correcta y el valor que deseas relacionar
            $success = $anotherStmt->execute();
    
            // Verificar que la última inserción fue exitosa
            if ($success) {
                // Si todo ha ido bien, commit la transacción
                $this->db->commit();
                // Retornar true indicando éxito
                return true;
            } else {
                // Si la inserción falló, hacer rollback y lanzar una excepción
                $this->db->rollback();
                throw new \Exception("Error al insertar en datos_personales.");
            }
        } catch (\Exception $e) {
            // Si algo sale mal en general, revertir (rollback) la transacción
            $this->db->rollback();
            // Puedes decidir si lanzar la excepción o manejar el error de otra manera
            throw $e;
        }
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
