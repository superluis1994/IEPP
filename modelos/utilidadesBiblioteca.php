<?php
require_once "principal.php";
class utilidadesBiblioteca extends Principal {
 
    //crear grupos
    public function registrar_grupo($datos){
        $sql=Principal::conectar()->prepare("INSERT INTO grupo (nombregrupo,fecha_crea,fecha_iniciogrupo,fecha_fingrupo,cierre_inscript,id_creador,estado,codigo)
        VALUES (:NOMBRE,:CREAR,:INICIO,:FIN,:INSCRIPT,:CREADOR,:ESTADO,:CODE)");
        $sql->bindParam(":NOMBRE",$datos['nombre']);
        $sql->bindParam(":CREAR",$datos['creacion']);
        $sql->bindParam(":INICIO",$datos['inicio']);
        $sql->bindParam(":FIN",$datos['fin']);
        $sql->bindParam(":INSCRIPT",$datos['activo']);
        $sql->bindParam(":CREADOR",$datos['id']);
        $sql->bindParam(":ESTADO",$datos['estado']);
        $sql->bindParam(":CODE",$datos['code']);
        $sql->execute();
        return $sql;
    }

    public function consulta_preparada2($query){
        $sql=Principal::conectar()->prepare($query);
        $sql->execute(); 
        $dat=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $dat;
    }
    //agregar coleccion cuando se agregue el libro
    public function agregar_coleccion($datos){
        $sql=Principal::conectar()->prepare("INSERT INTO colecciones (nom_coleccion,estado)
         VALUES (:NOMBRE,:ESTADO)");
        $sql->bindParam(":NOMBRE",$datos['nombre']);  
        $sql->bindParam(":ESTADO",$datos['estado']);   
        $sql->execute();
        return $sql;
        
        }

        public function generar(){
         $var=Principal::codigo(9,6);
         return $var;
        }

        public function verifica_coleccion($datos){
            $sql=Principal::conectar()->prepare("SELECT * FROM coleccion WHERE nombre=:NOMBRE ");
            $sql->bindParam(":NOMBRE",$datos);  
            $sql->execute();
            return $sql;
            
            }
            public function busquedaColeccion($datos){
                $sql=Principal::conectar()->prepare("SELECT * FROM colecciones WHERE nom_coleccion LIKE :NOMBRE");
                $sql->bindParam(":NOMBRE",$datos);  
                $sql->execute();
                $dat=$sql->fetchAll(PDO::FETCH_ASSOC);
                return $dat;
                
                }
/////////////////////////// Seccion Modulo//////////////////////////////////////////

    //crearmodulo
    public function Crear_modulo($datos){
        $sql=Principal::conectar()->prepare("INSERT INTO modulo (nombre,cantidad,estado)
         VALUES (:NOMBRE,:CANTIDAD,:ESTADO)");
        $sql->bindParam(":NOMBRE",$datos['nombre']);  
        $sql->bindParam(":CANTIDAD",$datos['cantidad']);  
        $sql->bindParam(":ESTADO",$datos['estado']);  
        $sql->execute();
        return $sql;
        
        }

        // busqueda generales
        public function busqueda($dato){
            $sql=Principal::conectar()->prepare("SELECT * FROM ".$dato['tabla']." WHERE ".$dato['campo']." LIKE '%".$dato["nombre"]."%' LIMIT 0, 15;");
           $sql->execute();
           $dat=$sql->fetchAll(PDO::FETCH_ASSOC);
           return $dat;
           
        }
        
    /////////////////////////// final Seccion Modulo//////////////////////////////////////////

        public function Crear_estante($sql1){
            $sql=Principal::conectar()->prepare($sql1); 
            $sql->execute();
            return $sql;
            
            }
    //Consulta via script preparada

    public function consulta_preparada($tabla){
        $sql=Principal::conectar()->prepare($tabla);
        $sql->execute(); 
        $dat=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $dat;
    }
    public function obtenerDatos($tabla){
        $sql=Principal::conectar()->prepare($tabla);
        $sql->execute(); 
        return $sql;
    }
    
    
            //Esta Funcion sirve para recuperar modulo id y para verificar si existe el modulo
        // public function obtener_id_modulo($dato){
        //     $sql=Principal::conectar()->prepare("SELECT * FROM modulo WHERE nombre= :NOMBRE");
        //     $sql->bindParam(":NOMBRE",$dato);  
        //    $sql->execute();
        //    return $sql;
        // }
        public function obtener_id_modulo($dato){
                $sql=Principal::conectar()->prepare("SELECT * FROM modulo WHERE nombre= :NOMBRE");
                $sql->bindParam(":NOMBRE",$dato);  
               $sql->execute();
               return $sql;
            }

//verificar datos_cuenta
public function verificar_usuario($datos){

    $sql=Principal::conectar()->prepare("SELECT * FROM usuario WHERE correo=:CORREO");
    $sql->bindParam(":CORREO",$datos); 
    $sql->execute();
    return $sql;
    
    }
    //inicio de Agregar usuario
public function agregar_usuario($datos){

$sql=Principal::conectar()->prepare("INSERT INTO usuario(nombre,apellido,correo,clave,genero,fecha_regist,estado)
 VALUES (:NOMBRE,:APELLIDO,:CORREO,:CLAVE,:GENERO,:FECHA,:ESTADO)");
$sql->bindParam(":NOMBRE",$datos['nombre']); 
$sql->bindParam(":APELLIDO",$datos['apellido']); 
$sql->bindParam(":CORREO",$datos['correo']); 
$sql->bindParam(":CLAVE",$datos['clave']);
$sql->bindParam(":GENERO",$datos['genero']);
$sql->bindParam(":FECHA",$datos['fecha']);
$sql->bindParam(":ESTADO",$datos['estado']); 
$sql->execute();

return $sql;
}
public function agregar_datos_usuario($dato){
    $sql=Principal::conectar()->prepare("INSERT INTO datos_usuario (telefono ,fecha_nacimiento , departamento, municipio, direccion, fecha_regist, fk_usuario)
    VALUES(:TEL,:FECHANAC,:DEPART,:MUNIC,:DIRECC,:REGISFECH,:ID);");
    $sql->bindParam(":TEL",$dato['telefono']); 
    $sql->bindParam(":FECHANAC",$dato['nacimiento']);
    $sql->bindParam(":DEPART",$dato['departamento']);
    $sql->bindParam(":MUNIC",$dato['municipio']);
    $sql->bindParam(":DIRECC",$dato['direccion']); 
    $sql->bindParam(":REGISFECH",$dato['fechaRegis']); 
    $sql->bindParam(":ID",$dato['id_usuario']); 
    $sql->execute();
    return $sql;
    }

public function RecuperarId($datos){

    $sql=Principal::conectar()->prepare("SELECT * FROM usuario WHERE correo=:CORREO");
    $sql->bindParam(":CORREO",$datos); 
    $sql->execute();
    return $sql;
    }

    public function ListaDatos($dato){
        $sql=Principal::conectar()->prepare("SELECT * FROM ".$dato." LIMIT 0, 15;"); 
        $sql->execute();
        $dat=$sql->fetchAll(PDO::FETCH_ASSOC);
        return $dat;
        }

public function agregar_autor($datos){

    $sql=Principal::conectar()->prepare("INSERT INTO autor (nombre,genero,foto,pais,ciudad_nat,fecha_nacimi,fecha_regis,estado)
     VALUES (:NOMBRE,:GENERO,:FOTO,:PAIS,:CIUDAD,:NACIMIENTO,:REGISTRO,:ESTADO)");
    $sql->bindParam(":NOMBRE",$datos['nombre']); 
    $sql->bindParam(":GENERO",$datos['genero']); 
    $sql->bindParam(":FOTO",$datos['foto']);
    $sql->bindParam(":PAIS",$datos['pais']);
    $sql->bindParam(":CIUDAD",$datos['ciudanat']);
    $sql->bindParam(":NACIMIENTO",$datos['fechaNac']);
    $sql->bindParam(":REGISTRO",$datos['fechaR']); 
    $sql->bindParam(":ESTADO",$datos['estado']); 
    $sql->execute();
    return $sql;
    
    }
public function cargar_usuarios_busqueda($datos){

    $sql=Principal::conectar()->prepare("SELECT * FROM usuario  WHERE". ":CAMPO = :BUSQUEDA LIMIT 0, 5;");
    $sql->bindParam(":CAMPO",$datos['filtro']);
    $sql->bindParam(":BUSQUEDA",$datos['texto']); 
    $sql->execute();
    $dat=$sql->fetchAll(PDO::FETCH_ASSOC);

    return $dat;
    
    }
    public function cargar_usuarios(){

        $sql=Principal::conectar()->prepare("SELECT * FROM usuario LIMIT 0, 5;");
        $sql->execute();
        $dat= $sql->fetchAll(PDO::FETCH_ASSOC);
        return $dat;
        
        }
    
       

        public function ActualizarEstado($datos){

            $sql=Principal::conectar()->prepare("UPDATE ".$datos["Tabla"]." SET  ".$datos["campo"]." = :DATO WHERE  ".$datos["campo2"]." = :ID;");
            $sql->bindParam(":DATO",$datos["datoAct"]); 
            $sql->bindParam(":ID",$datos["id"]); 
            $sql->execute();
            return $sql;
            }




public function agregar_editorial($datos){
  $sql=Principal::conectar()->prepare("INSERT INTO editorial (cod_edi,nombre,direccion,telefono ,correo)
  VALUES (:EDITORIAL,:NOMBRE,:DIRECCION,:TELEFONO,:CORREO)");
            
$sql->bindParam(":EDITORIAL",$datos['codigo']); 
$sql->bindParam(":NOMBRE",$datos['nombre']); 
$sql->bindParam(":DIRECCION",$datos['dire']); 
$sql->bindParam(":TELEFONO",$datos['tele']); 
$sql->bindParam(":CORREO",$datos['mail']);
$sql->execute();
return $sql;
                 }

////////////////////////seccion de prestamos////////////////////////////////////////////////////////////
public function busquedalibroPres($datos){

    $sql=Principal::conectar()->prepare("SELECT * FROM ejemplar INNER JOIN libro ON ejemplar.id_libro=libro.id_libro WHERE id_ejemplar LIKE :BUSQUEDA LIMIT 0, 4");
   
    $sql->bindParam(":BUSQUEDA",$datos['dato']); 
    $sql->execute();
    $dat= $sql->fetchAll(PDO::FETCH_ASSOC);
    return $dat;
              
           } 

//busqueda perfsonalizada: se piden datos tabla, campo y dato a buscar
//nota se puede reusar//
public function busquedasPersonaliza($datos){

  $sql=Principal::conectar()->prepare("SELECT * FROM ".$datos["tabla"]." WHERE ".$datos["campo"]." LIKE :BUSQUEDA LIMIT 0, 5;");
  $sql->bindParam(":BUSQUEDA",$datos['dato']); 
  $sql->execute();
  $dat= $sql->fetchAll(PDO::FETCH_ASSOC);
  return $dat;
            
         }

////////////////////////Fin seccion de prestamos////////////////////////////////////////////////////////////


                 //fin de la clase
}

?>