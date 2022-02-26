<?php
require_once "modelos/modeloLogin.php";

class controladorLogin extends modeloLogin {
   
   public function iniciar_session_controlador(){ 
    //se resiven las variables post del login
    $correo=$_POST['correo'];
    $clave=$_POST['clave'];

    //proceso de encriptado
    $key=Principal::encryption($clave);

    $datos_login=[
        "correo"=>$correo,
        "clave"=>$key
    ];

    $datos_cuenta=modeloLogin::iniciar_session_modelo($datos_login);
    
    if($datos_cuenta->rowCount()==1){
        $row=$datos_cuenta->fetch();

        //esta session se evaluara en el login para que pueda pasar
        session_start();
        $_SESSION["prueba"]=$row['id_empleado'];
        //$_SESSION['nombre']=$row['nombre'];
       //si returna 1 columna esta sera la ruta
        
     return header("Location: ".SERVER_URL."admin/home");
 
    }else{
        //caso contrario se muestra este mensaje en login
        echo "<script>
        alert('El usuario no existe')
        </script>";

    }
      
  
   return $respuesta;
        }
    
}

?>