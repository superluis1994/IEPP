<?php 
namespace app\Setting;
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


