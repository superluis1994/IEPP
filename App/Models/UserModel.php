<?php

namespace App\Models;
use App\Setting\Conexion;
use App\Setting\Encryptar;
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
    }

    // METODO PARA VALIDAR LOS DATOS DEL DIRECTIVO Y RETORNAR LOS DATOS
    public function validateUser(array $data)
    {   
        // $camposArray = array_values($data);
        // $campos = implode(", ", $camposArray);
        $stmt = $this->db->prepare("SELECT  cg.id_hermano as id, cg.usuario as dui, cg.password as passwor, dtp.nombre, dtp.apellido,
                                            tus.titulo as tipoUser
                                    FROM congregacion cg
                                    INNER JOIN datos_personales dtp ON dtp.id_congregacion = cg.id_hermano
                                    INNER JOIN tipo_de_usuario tus ON tus.id_tipo_usuario = cg.tipo_usuario
                                    WHERE cg.usuario = :USUARIO;");
                                    $stmt->bindParam(":USUARIO", $data["usuario"], PDO::PARAM_STR);
                                    $stmt->execute();
                                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function datosUser(array $data)
    {   
        // $camposArray = array_values($data);
        // $campos = implode(", ", $camposArray);
        $stmt = $this->db->prepare("SELECT drt.id_directiva, cg.id_hermano as id, cg.usuario as dui, cg.password as passwor, 
        SUBSTRING_INDEX(dtp.nombre, ' ', 1) AS nombre,
         SUBSTRING_INDEX(SUBSTRING_INDEX(dtp.apellido, ' ', 1), ' ', -1) AS apellido,
                                           drt.year, td.titulo,tus.titulo as tipoUser
                                    FROM {$this->tabla} {$this->alias}
                                    INNER JOIN datos_personales dtp ON dtp.id_congregacion = cg.id_hermano
                                    INNER JOIN directivos dr ON dr.id_congregacion  = cg.id_hermano
                                    INNER JOIN directiva drt ON drt.id_directiva = dr.id_directiva
                                    INNER JOIN tipo_directiva  td ON td.id_tipo_directiva = drt.id_tipo_directiva
                                    INNER JOIN tipo_de_usuario tus ON tus.id_tipo_usuario = cg.tipo_usuario
                                    WHERE cg.usuario = :USUARIO  AND drt.status = 1;");
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

    // public function createUsuario(array $data , array $permisos)
    // {
    //     // Iniciar la transacción
    //     $this->db->beginTransaction();
        
    //     try {
    //         $INSTANCIA= new Encryptar($_ENV["JWT_SECRET_KEY"]);
    //         $passwordEncry = $INSTANCIA->encrypt($data["contraseña"]);
    
    //         $stmt = $this->db->prepare("INSERT INTO {$this->tabla} (usuario,`password`,email,tipo_usuario,`status`) 
    //                                     VALUES (:USUARIO,:PASSWOR,:EMAIL,:TIPO,:STATU)");
    //         $stmt->bindValue(":USUARIO", $data["dui"]);
    //         $stmt->bindValue(":PASSWOR", $passwordEncry);
    //         $stmt->bindValue(":EMAIL", $data["email"]);
    //         $stmt->bindValue(":TIPO", 3);
    //         $stmt->bindValue(":STATU", 1);
            
    //         // Ejecutar la consulta de inserción
    //         $stmt->execute();
    
    //         // Obtener el ID generado por la inserción
    //         $insertedId = $this->db->lastInsertId();
            
    //         // Aquí puedes usar $insertedId para hacer otra inserción o cualquier operación necesaria
    //         $anotherStmt = $this->db->prepare("INSERT INTO datos_personales (nombre, apellido, telefono, id_congregacion) VALUES (:NOMBRE, :APELLIDOS, :TELEFONO, :IDCONGREGACION)");
    //         $anotherStmt->bindValue(":NOMBRE", strtoupper($data["nombre"]));
    //         $anotherStmt->bindValue(":APELLIDOS", strtoupper($data["apellidos"]));
    //         $anotherStmt->bindValue(":TELEFONO", "+503 ".$data["telefono"]);
    //         $anotherStmt->bindValue(":IDCONGREGACION", $insertedId); // Asegúrate de que esta es la columna correcta y el valor que deseas relacionar
    //         $success = $anotherStmt->execute();
    
    //         // Verificar que la última inserción fue exitosa
    //         if ($success) {
    //             // Si todo ha ido bien, commit la transacción
    //             $this->db->commit();
    //             // Retornar true indicando éxito
    //             return true;
    //         } else {
    //             // Si la inserción falló, hacer rollback y lanzar una excepción
    //             $this->db->rollback();
    //             throw new \Exception("Error al insertar en datos_personales.");
    //         }
    //     } catch (\Exception $e) {
    //         // Si algo sale mal en general, revertir (rollback) la transacción
    //         $this->db->rollback();
    //         // Puedes decidir si lanzar la excepción o manejar el error de otra manera
    //         throw $e;
    //     }
    // }

    public function createUsuario(array $data, array $permisos,$tipoUser)
{
    // Iniciar la transacción
    $this->db->beginTransaction();
    
    try {
        $INSTANCIA = new Encryptar($_ENV["JWT_SECRET_KEY"]);
        $passwordEncry = $INSTANCIA->encrypt($data["contraseña"]);

        $stmt = $this->db->prepare("INSERT INTO {$this->tabla} (usuario,`password`,email,tipo_usuario,`status`) 
                                    VALUES (:USUARIO,:PASSWOR,:EMAIL,:TIPO,:STATU)");
        $stmt->bindValue(":USUARIO", $data["dui"]);
        $stmt->bindValue(":PASSWOR", $passwordEncry);
        $stmt->bindValue(":EMAIL", $data["email"]);
        $stmt->bindValue(":TIPO", $tipoUser);  // Aquí puedes considerar ajustar según el tipo de usuario si es necesario
        $stmt->bindValue(":STATU", 1);
        
        // Ejecutar la consulta de inserción
        $stmt->execute();

        // Obtener el ID generado por la inserción
        $insertedId = $this->db->lastInsertId();
        
        // Inserción de datos personales
        $anotherStmt = $this->db->prepare("INSERT INTO datos_personales (nombre, apellido, telefono, id_congregacion) VALUES (:NOMBRE, :APELLIDOS, :TELEFONO, :IDCONGREGACION)");
        $anotherStmt->bindValue(":NOMBRE", strtoupper($data["nombre"]));
        $anotherStmt->bindValue(":APELLIDOS", strtoupper($data["apellidos"]));
        $anotherStmt->bindValue(":TELEFONO", "+503 ".$data["telefono"]);
        $anotherStmt->bindValue(":IDCONGREGACION", $insertedId);
        $anotherStmt->execute();

         // Suponiendo que necesitas determinar si insertar en directivos
         if ($tipoUser == 2) { // Ajusta esta condición según tus necesidades
            $directivosStmt = $this->db->prepare("INSERT INTO directivos (id_directiva, id_congregacion,usuario_creacion, status) VALUES (:IDDIRECTIVA, :IDCONGREGACION,:USERCREACION,:STATUS)");
            $directivosStmt->bindValue(":IDDIRECTIVA", $data["directiva"]); // Suponiendo que `id_directiva` usa el mismo ID
            $directivosStmt->bindValue(":IDCONGREGACION", $insertedId); // Asumiendo que es el mismo ID, ajusta según sea necesario
            $directivosStmt->bindValue(":STATUS", 1); // Estado activo por ejemplo
            $directivosStmt->bindValue(":USERCREACION",$insertedId);
            $directivosStmt->execute();
        }

        // Asignar permisos predeterminados
        foreach ($permisos as $idMenu => $permisos) {
            foreach ($permisos as $tipoPermiso) {
                $permisosStmt = $this->db->prepare("INSERT INTO permisos_user (id_hermano, id_menu, tipo_permiso) VALUES (:IDHERMANO, :IDMENU, :TIPOPERMISO)");
                $permisosStmt->bindValue(":IDHERMANO", $insertedId);
                $permisosStmt->bindValue(":IDMENU", $idMenu);
                $permisosStmt->bindValue(":TIPOPERMISO", $tipoPermiso);
                
                $permisosStmt->execute();
            }
        }

        // Si todo ha ido bien, commit la transacción
        $this->db->commit();
        // Retornar true indicando éxito
        return true;
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
