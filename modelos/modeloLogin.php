<?php
require_once "principal.php";
class modeloLogin extends Principal {
 
    //inicio de session de usuario (A y B)
public function iniciar_session1_modelo($datos){
$sql=Principal::conectar()->prepare("SELECT * FROM empleado WHERE correoem=:CORREO
 AND claveem=:CLAVE AND estado='A'" );
$sql->bindParam(":CORREO",$datos['correo']); 
$sql->bindParam(":CLAVE",$datos['clave']); 
$sql->execute();
return $sql;

}
  
 //inicio de session de usuario normal
 public function iniciar_session2_modelo($datos){
    $sql=Principal::conectar()->prepare("SELECT * FROM usuario WHERE correo=:CORREO
     AND clave=:CLAVE AND estado='A'" );
    $sql->bindParam(":CORREO",$datos['correo']); 
    $sql->bindParam(":CLAVE",$datos['clave']); 
    $sql->execute();
    return $sql;
    
    }
      
}


?>