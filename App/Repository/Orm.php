<?php

namespace app\Repository;
// class Orm {
    
//     /**METODO PARA MOSTRAR TODOS LOS REGISTROS */
//     public static function all(string $Tabla, $clase){

//     }
// }

interface Orm 
{

 /*==================================
   Método para insertar datos en las tablas["clave"=>valor]
 ====================================*/
 public function Insert(array $datos); /// ["name"=>"name usuario","email"=>""]

 
 /*==================================
   Método all (muestra todo registro)
 ====================================*/

 public static function all();

  /*==================================
   Método Where
 ====================================*/
//  public function Where(string $atributo,$operador,$valor);
 public function Where(string $atributo,$operador,$valor);
 /*==================================
  Método Where con multiples condiciones
====================================*/
 public function Mult_Where(array $datos);
 

/*==================================
   Método First
 ====================================*/

 public function first();

 public function get();
 
 public function MultJoin(array $datos);

 public function Join(string $TablaFk,string $Fk,string $operador,string $PK);




 public function OrderBy(string $atributo,$secuencia);

 /// Implementar el método Having y WhereAnd (Tarea)


 /// Método Update

 public function Update(array $datos);

 /// Método delete

 public function delete($id);

  /// procedimiento almacenado para realizar [CRUD COMPLETO]
 public function procedure(string $NameProcedure,$evento,array $datos=[]);




}