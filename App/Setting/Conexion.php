<?php 
namespace app\Setting;
use MongoDB\MongoDB;
use MongoDB\Client;
use PDO;

class Conexion
{
    public static string $Query;

    private static ?Client $MongoConnector = null;

    private static ?PDO $Conector = null;

    public static $Pps = null;


    public static function getConexion_(): ?PDO
    {
        try {
            if (self::$Conector === null) {
                self::$Conector = new PDO(
                    "mysql:host=" . $_ENV["DB_HOST"] . ";dbname=" . $_ENV["DB_NAME"],
                    $_ENV["DB_USER"],
                    $_ENV["DB_PASSWORD"]
                );

                self::$Conector->exec("set names utf8");
                self::$Conector->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

        return self::$Conector;
    }
    public function mongoDbConexion(){
        try {

            $Mongo = "mongodb+srv://".
            $_ENV["MONGODB_USERNAME"].":".
            $_ENV["MONGODB_PASSWORD"]."@".
            $_ENV["MONGODB_SERVIDOR"]."/".
            $_ENV["MONGODB_DB"];
            self::$MongoConnector = new client($Mongo);
            // self::$MongoConnector->selectDatabase($_ENV["MONGODB_DB"]);
            return self::$MongoConnector;
        } catch(\Throwable $th){
           return $th->getMessage();
        }
    }

//     public static function getMongoConexion()
// {
//     if (self::$MongoConnector === null) {
//         self::$MongoConnector = new Client($_ENV["MONGODB_URI"]);
        
//     }

//     return self::$MongoConnector;
// }


    

    public static function closeConexionBD()
    {
        if (self::$Conector !== null) {
            self::$Conector = null;
        }

        if (self::$Pps !== null) {
            self::$Pps = null;
        }
    }

}


