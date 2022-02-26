<?php

require_once "configuraciones/credenciales.php";
require_once "configuraciones/SERVER.php";


class Principal {
//conexion a la base de datos
protected static function conectar(){
	
	//las constantes vienen de contenido/XMLCARP/credenciales.php
try {
$mbd = new PDO("mysql:host=".SERVIDOR.";dbname=".BASEDATOS, USUARIO, CONTRA);  
} catch (PDOException $e) {
$mbd = "Erro al conectar".$e;
die();
}

//retorna la conexion
return $mbd;
}

//consultas 
private static function ejecutar($query){
$sql=self::conectar()->prepare($query);
$sql->execute();
return $sql;
}

//Funcion de encriptado para las claves
public function encryption($string){
$output=FALSE;
$key=hash('sha256', SECRET_KEY);
$iv=substr(hash('sha256', SECRET_IV), 0, 16);
$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
$output=base64_encode($output);
return $output;
}
//funcion de desencriptar para claves
public function decryption($string){
$key=hash('sha256', SECRET_KEY);
$iv=substr(hash('sha256', SECRET_IV), 0, 16);
$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
return $output;
}

//Limpiar cadenas
protected static function cadenaTexto($cadena){
//trim elimina espacios    
$cadena=str_ireplace("<script>","",$cadena);
$cadena=str_ireplace("</script>","",$cadena);
$cadena=str_ireplace("<script src>","",$cadena);
$cadena=str_ireplace("<script type=>","",$cadena);
$cadena=str_ireplace("SELECT * FROM","",$cadena);
$cadena=str_ireplace("DELETE FROM","",$cadena);
$cadena=str_ireplace("INSERT INTO","",$cadena);
$cadena=str_ireplace("DROP TABLE","",$cadena);
$cadena=str_ireplace("DROP DATABASE","",$cadena);
$cadena=str_ireplace("TRUNCATE TABLE","",$cadena);
$cadena=str_ireplace("SHOW TABLE","",$cadena);
$cadena=str_ireplace("SHOW DATABASE","",$cadena);
$cadena=str_ireplace("<?php","",$cadena);
$cadena=str_ireplace("?>","",$cadena);
$cadena=str_ireplace("<","",$cadena);
$cadena=str_ireplace(">","",$cadena);
$cadena=str_ireplace("[","",$cadena);
$cadena=str_ireplace("]","",$cadena);
$cadena=stripslashes($cadena);
$cadena=trim($cadena);
return $cadena;
}

//Generador de codigo aleatorio
protected static function codigo($logitud,$numero){
  $val=""; 
for($i=0; $i<=$logitud; $i++){
$aletorio=rand(0,9);
$val.=$aletorio;

}
return $val;
}
//paginacion de tablas
protected static function paginador($pagina,$nPagina,$url,$botones){
$tabla="Encabezado de la tabla";
if($pagina==1){
$tabla.="";
}else{

}
$tabla.="cierre";
    return $tabla;
}

//fin de la clase
}

?>