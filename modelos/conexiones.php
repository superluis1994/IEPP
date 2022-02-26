<?php

require_once "principal.php";
class funciones extends Principal {
 
    //Actualizo los datos principales
    public function actualizarDatos(){
        $sql=Principal::conectar()->prepare("SELECT * FROM sedes");
        $sql->execute();
        $dat=$sql->fetch();
        // return $sql;
       
         if(file_exists("configuraciones/DatoSede.php")){
            unlink("configuraciones/DatoSede.php");
         }
             $datos=fopen("configuraciones/DatoSede.php","a");
             fwrite($datos,"<?php \n");
             fwrite($datos,"const Titulo='".$dat['nombre_sede']."';\n");
             fwrite($datos,"?>");
         

    }

}


?>