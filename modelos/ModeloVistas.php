<?php

class ModeloVistas {
    

         public static function obtener_vista_modelo($tipo,$vistas){
        
            //evaluar usuario para mostrar contenido
            if($tipo=="admin"){

                $listaVistas=["home","usuario-add","lista-usuario","perfil-admin",
            "editar-perfil","ejemplo","tupuedes", ];
                if(in_array($vistas,$listaVistas)){
                 $contenido='./vistas/admin/contenido/'.$vistas.'-url.php';
                   
                }else{
                    $vistas="home";
                    $contenido='./vistas/admin/contenido/'.$vistas.'-url.php'; 
                }

            }elseif($tipo=="usuario"){
                $listaVistas=["home","lista-client","libro-add"];
                if(in_array($vistas,$listaVistas)){
                 $contenido='./vistas/alumno/contenido/'.$vistas.'-url.php';
                   
                }else{
                    $vistas="home";
                    $contenido='./vistas/admin/contenido/'.$vistas.'-url.php'; 
                }
            }
            

            return $contenido;
            }



    
}


?>