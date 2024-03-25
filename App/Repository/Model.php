<?php

namespace app\Repository;

use App\Repository\Orm;
use App\Setting\Conexion;

class Model extends Conexion implements Orm
{
   protected $Tabla;

   private array $Value = [];

   private array $ValuesWhereOr = [];

   protected $alias; /// alias de la tabla

   /// primary key pk del modelo

   protected $primaryKey;
   /*==================================
   Método all (muestra todo registro)
  
 ====================================*/

   public function Query()
   {
      $Tabla = $this->Tabla . " $this->alias";   /// cuando es consulta le aplicamos alias al modelo
      self::$Query = "SELECT * FROM $Tabla";
      return $this;
   }

   public function QueryEspefico(array $campo)
   {
      self::$Query = "SELECT ";
      foreach ($campo as $key => $value) {
         self::$Query .= $value . ",";
      }
      self::$Query = rtrim(self::$Query, ",");
      self::$Query .= " FROM " . $this->Tabla . " $this->alias";
      // echo self::$Query;
      return $this;
   }

   public static function all()
   {
      try {
         self::$Pps = self::getConexion_()->prepare(self::$Query);
         self::$Pps->execute();
         return self::$Pps->fetchAll();
      } catch (\Throwable $th) {
         echo $th->getMessage();
      }
   }
   /*==================================
 Método Where con una condicion
====================================*/
   public function Where(string $atributo, $operador, $valor)
   {
      self::$Query .= " WHERE $atributo $operador :" . $atributo;

      $this->Value[] = [
         "campo" => $atributo,
         "value" => $valor
      ];
      //  echo $valor;
      //   echo self::$Query;
      return $this;
   }

   public function Singlefirst()
   {
      try {
         self::$Pps = self::getConexion_()->prepare(self::$Query);
         //   self::$Pps->bindParam(1,$this->Value);
         foreach ($this->Value as $key => $value) {
            self::$Pps->bindParam(":" . $value['campo'], $value['value']);
         }
         self::$Pps->execute();

         if (self::$Pps->rowCount() > 0) {
            return self::$Pps->fetchAll(\PDO::FETCH_OBJ)[0];
         }
         return [];
      } catch (\Throwable $th) {
         echo $th->getMessage();
      } finally {
         self::closeConexionBD();
      }
   }

   /*==================================
   Método Where con varias condicionales
 ====================================*/
   public function Mult_Where(array $datos)
   {
      self::$Query .= " WHERE ";
      foreach ($datos as $atributo => $value) {
         self::$Query .= $value['atributo'] . " " . $value['condicion'] . " :" . str_replace('.', '', $value['atributo']) . " " . $value['operador'] . " ";
         $valor = str_replace('.', '', $value['atributo']);
         $this->Value[] = [
            "campo" => $valor,
            "value" => $value['value']
         ];
      }
      // echo self::$Query;
      return $this;
   }

   /*==================================
   Método First
 ====================================*/

   public function first()
   {
      try {
         self::$Pps = self::getConexion_()->prepare(self::$Query);
         foreach ($this->Value as $key => $value) {
            self::$Pps->bindParam(":" . $value['campo'], $value['value']);
         }

         self::$Pps->execute();

         if (self::$Pps->rowCount() > 0) {
            // return self::$Pps->fetchAll(\PDO::FETCH_OBJ);
            return self::$Pps->fetchAll();
         }
         return [];
         unset($this->Value);
      } catch (\Throwable $th) {
         echo $th->getMessage();
      } finally {
         self::closeConexionBD();
      }
   }


   public function get()
   {

      try {
         self::$Pps = self::getConexion_()->prepare(self::$Query);

         if (!empty($this->Value)) {
            self::$Pps->bindParam(1, $this->Value);
         }

         if (count($this->ValuesWhereOr) > 0) {
            for ($i = 0; $i < count($this->ValuesWhereOr); $i++) {
               self::$Pps->bindParam(($i + 2), $this->ValuesWhereOr[$i]);
            }
         }
         self::$Pps->execute();
         return self::$Pps->fetchAll();
      } catch (\Throwable $th) {
         echo $th->getMessage();
      } finally {
         self::closeConexionBD();
      }
   }


   public function MultJoin(array $datos)
   {

      foreach ($datos as $key => $value) {

         self::$Query .= " INNER JOIN " . $value["tablaFk"] . " ON " . $value["tablaPk"] . "." . $value["pk"] . " = " . $value["tablaFk"] . "." . $value["fk"];
      }
      // echo self::$Query;
      return $this;
   }
   public function Join(string $TablaFk, string $Fk, string $operador, string $PK)
   {
      self::$Query .= " INNER JOIN $TablaFk ON $Fk $operador $PK";
      return $this;
   }

   public function OrderBy(string $atributo, $secuencia)
   {
      self::$Query .= " ORDER BY $atributo $secuencia";

      return $this;
   }
   public function Limite(string $limite)
   {
      self::$Query .= "  LIMIT $limite ";

      return $this;
   }

   //// INSERT INTO TABLA(atributo1,atributo2) VALUES(:atributo1,:atributo2)
   /// bindParam | bindValue

   // public function Insert(array $datos)
   // {
   //    $this->Tabla = str_replace($this->alias, "", $this->Tabla);

   //    self::$Query = "INSERT INTO $this->Tabla(";

   //    foreach ($datos as $key => $value) {
   //       self::$Query .= $key . ",";
   //    }



   //    self::$Query = rtrim(self::$Query, ",") . ") VALUES(";

   //    foreach ($datos as $key => $value) {
   //       self::$Query .= " :$key" . ",";
   //    }

   //    /// eliminamos la ultima coma

   //    self::$Query = rtrim(self::$Query, ",") . ")";
   //    echo self::$Query;
   //    try {
   //       self::$Pps = self::getConexion_()->prepare(self::$Query);

   //       foreach ($datos as $key => $value) {

   //          self::$Pps->bindValue(":" . $key, $value);
   //       }


   //       return self::$Pps->execute(); /// 0 | 1
   //    } catch (\Throwable $th) {
   //       return $th->getMessage();
   //    } finally {
   //       self::closeConexionBD();
   //    }
   // }


   public function Insert(array $datos)
   {
       $this->Tabla = str_replace($this->alias, "", $this->Tabla);

       self::$Query = "INSERT INTO $this->Tabla(";

       foreach ($datos as $key => $value) {
           self::$Query .= $key . ",";
       }

       self::$Query = rtrim(self::$Query, ",") . ") VALUES(";

       foreach ($datos as $key => $value) {
           self::$Query .= " :$key" . ",";
       }

       self::$Query = rtrim(self::$Query, ",") . ")";

       try {
           self::$Pps = self::getConexion_()->prepare(self::$Query);

           foreach ($datos as $key => $value) {
               self::$Pps->bindValue(":" . $key, $value);
           }

           if (self::$Pps->execute()) {
               // Retrieve the last inserted ID using PDO's lastInsertId() method
               $insertedId = self::getConexion_()->lastInsertId();
               return $insertedId;
           } else {
               return false; // Or handle the error differently
           }
       } catch (\Throwable $th) {
           return $th->getMessage();
       } finally {
           self::closeConexionBD();
       }
   }



   /// Método Update => UPDATE estudiante set nombres=:nombres,apellidos=:apellidos where id_estudiante=:id_estudiante

   public function Update(array $datos)
   {
      self::$Query = "UPDATE $this->Tabla SET ";

      /// le especificamos que atributos vamos a modificar

      foreach ($datos as $atributo => $value) {
         self::$Query .= "$atributo=:$atributo,";
      }
      /// eliminamos la ultima coma

      self::$Query = rtrim(self::$Query, ",") . " WHERE " . array_key_first($datos) . "=:" . array_key_first($datos);

      /// el proceso de pdo para ejecutar dicha query

      try {
         self::$Pps = self::getConexion_()->prepare(self::$Query);

         foreach ($datos as $key => $value) {
            self::$Pps->bindValue(":$key", $value);
         }

         return self::$Pps->execute(); /// 0 | 1

      } catch (\Throwable $th) {
         echo $th->getMessage();
      } finally {
         self::closeConexionBD();
      }
   }

   /// Método delete => DELETE FROM TABLA WHERE id

   public function delete($id)
   {

      self::$Query = "DELETE FROM $this->Tabla WHERE $this->primaryKey=:$this->primaryKey";

      /// el proceso de pdo para ejecutar dicha query

      try {
         self::$Pps = self::getConexion_()->prepare(self::$Query);

         self::$Pps->bindParam(":$this->primaryKey", $id);

         return self::$Pps->execute(); /// 0 | 1

      } catch (\Throwable $th) {
         echo $th->getMessage();
      } finally {
         self::closeConexionBD();
      }
   }


   /// procedimiento almacenado para realizar [CRUD COMPLETO]
   public function procedure(string $NameProcedure, $evento, array $datos = [])
   {
      self::$Query = "CALL $NameProcedure(";

      foreach ($datos as $value) {
         self::$Query .= "?,";
      }

      self::$Query = rtrim(self::$Query, ",") . ")";

      try {
         self::$Pps = self::getConexion_()->prepare(self::$Query);

         for ($i = 0; $i < count($datos); $i++) {

            self::$Pps->bindValue(($i + 1), $datos[$i]);
         }
         if (strtoupper($evento) === 'C') {
            self::$Pps->execute();

            return self::$Pps->fetchAll();
         }

         return self::$Pps->execute();
      } catch (\Throwable $th) {
         //throw $th;
      }
   }
}
