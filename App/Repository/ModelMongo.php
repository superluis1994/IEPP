<?php

namespace app\repository;

use app\Repository\Orm;
use app\Setting\Conexion;

class ModelMongo extends Conexion 
{
   protected $Tabla;

   private array $Value;

   private array $ValuesWhereOr = [];
 

   public function MongoDBAll($collection)
{
  try {
    $conexion = parent::mongoDbConexion();
    $coleccion = $conexion->selectCollection($_ENV["MONGODB_DB"],$collection); // Select the collection
    $datos = $coleccion->find();
    return $datos;
  } catch (\Throwable $th) {
    return $th->getMessage();
  }
}
   public function MongoDBBusqueda($items)
{
  try {
    $conexion = parent::mongoDbConexion();
    $coleccion = $conexion->selectCollection($_ENV["MONGODB_DB"],$items["collection"]); // Select the collection
    $datos = $coleccion->find($items["consulta"]);
    return $datos;
  } catch (\Throwable $th) {
    return $th->getMessage();
  }
}

   
 
}
