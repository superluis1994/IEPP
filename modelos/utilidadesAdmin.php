<?php
require_once "principal.php";
class utilidadesAdmin extends Principal {
 
    //ejemplo
    public function ejemplo($datos){
        $sql=Principal::conectar()->prepare("INSERT INTO ejemplo(img,titulo,data)
        VALUES (:FOTO,:TEXTO,:FECHA )");

       $sql->bindParam(":FOTO",$datos['foto']); 
       $sql->bindParam(":TEXTO",$datos['texto']); 
       $sql->bindParam(":FECHA",$datos['fecha']); 
       $sql->execute();
       return $sql;
    }

    // agregar datos adicionales de administrar
    public function additional_information_admin($datos){
        $sql=Principal::conectar()->prepare("INSERT INTO datos_empleado(direccion,municipio,departamento,fotoem)
        VALUES (:DIR,:FECHA,:MUNI,:DEPAR,:FOTO )");

       $sql->bindParam(":DIR",$datos['dir']); 
      // $sql->bindParam(":ID",$datos['id']); 
      // $sql->bindParam(":FECHA",$datos['nacimiento']);
       $sql->bindParam(":MUNI",$datos['municipio']);
       $sql->bindParam(":DEPART",$datos['departamento']);
       $sql->bindParam(":FOTO",$datos['destino']); 
       $sql->execute();
       return $sql;
    }

    //ver imagenes
    public function insertar_categoria($dato1){
        $sql=Principal::conectar()->prepare("INSERT INTO categoria(cod_cat,nombre)
        VALUES (:CODE,:NOMBRE) ");
       $sql->bindParam(":CODE",$dato1['codigo']); 
       $sql->bindParam(":NOMBRE",$dato1['nombre']);  
       $sql->execute();
       return $sql;
        }

        public function verificar_categoria($datos){

            $sql=Principal::conectar()->prepare("SELECT * FROM categoria WHERE cod_cat=:CODE");
            $sql->bindParam(":CODE",$datos); 
            $sql->execute();
            return $sql;
            
            }
            //verificar datos_cuenta
            public function verificar_usuario($datos){

                $sql=Principal::conectar()->prepare("SELECT * FROM empleado WHERE correoem=:CORREO");
                $sql->bindParam(":CORREO",$datos); 
        $sql->execute();
        return $sql;
        
    }
    // aqui valido en las dos tabla si el usuario existe lo ise con la base de datosun procedimiento 
    public function consulta_usuario_existe($datos){
        
        $sql=Principal::conectar()->prepare("CALL validUsuario (:CORREO);");
        $sql->bindParam(":CORREO",$datos); 
        $sql->execute();
        return $sql;
        
    }
    
    //inicio de Agregar usuario
    public function agregar_usuario_modelo($datos){
        
        $sql=Principal::conectar()->prepare("INSERT INTO empleado(nombre,apellido,estado,fecha_registro,nivel,claveem,correoem)
 VALUES (:NOMBRE,:APELLIDO,:ESTADO,:FECHA,:NIVEL,:CLAVE,:CORREO) ");
$sql->bindParam(":NOMBRE",$datos['nombre']); 
$sql->bindParam(":APELLIDO",$datos['apellido']); 
$sql->bindParam(":ESTADO",$datos['estado']); 
$sql->bindParam(":FECHA",$datos['fechaRe']);
$sql->bindParam(":NIVEL",$datos['nivel']);
$sql->bindParam(":CLAVE",$datos['clave']);
$sql->bindParam(":CORREO",$datos['correo']); 
$sql->execute();
return $sql;

}
//obtener el id del usuarioregistrado
public function id_usuarioRegistrado($datos){

    $sql=Principal::conectar()->prepare("SELECT * FROM empleado WHERE correoem=:CORREO");
    $sql->bindParam(":CORREO",$datos["correo"]); 
    $sql->execute();
    return $sql;
    
    }
    public function cargaSelect($tabla){
        $sql=Principal::conectar()->prepare($tabla);
        $sql->execute(); 
        $dat=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $dat;
    }
public function agregar_datos_usuario($datos,$id){
        
        $sql=Principal::conectar()->prepare("INSERT INTO datos_empleado(direccion,id_empleado,fecha_contrato,cargo,telefono,fecha_nacimiento,municipio,departamento)
        VALUES(:DIRECCION,:ID,:FECHACONTRA,:NIVEL,:TELEFONO,:FECHANAC,:MUNICIPIO,:DEPARTAMENTO );");
$sql->bindParam(":DIRECCION",$datos['direccion']); 
$sql->bindParam(":ID",$id); 
$sql->bindParam(":FECHACONTRA",$datos['fechaRe']); 
$sql->bindParam(":NIVEL",$datos['nivel']);
$sql->bindParam(":TELEFONO",$datos['tel']);
$sql->bindParam(":FECHANAC",$datos['fechaNa']);
$sql->bindParam(":MUNICIPIO",$datos['muni']); 
$sql->bindParam(":DEPARTAMENTO",$datos['depart']); 
$sql->execute();
return $sql;

}

}


?>