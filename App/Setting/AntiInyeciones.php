<?php
namespace App\Setting;

class AntiInyeciones
{
    // Limpiar datos de entrada genéricos
    public static function cleanInput($data)
    {
        $data = trim($data); // Elimina espacios en blanco del inicio y el final
        $data = stripslashes($data); // Elimina las barras invertidas
        $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML
        return $data;
    }

    // Limpiar arrays de datos, como $_POST o $_GET
    // public static function cleanArray($dataArray)
    // {
    //     $cleanData = [];
    //     foreach ($dataArray as $key => $value) {
    //         // Limpia cada valor del array utilizando cleanInput
    //         $cleanData[$key] = self::cleanInput($value);
    //     }
    //     return $cleanData;
    // }
    public static function cleanDataArray($dataSpecs)
    {
        $cleanData = [];
        foreach ($dataSpecs as $key => $specs) {
            // Comprobar si el valor existe y obtenerlo
            $value = $specs['value'] ?? null;
            // Decidir el método de limpieza basado en el tipo especificado
            switch ($specs['type']) {
                case 'int':
                    $cleanData[$key] = self::cleanInt($value);
                    break;
                case 'string':
                    $cleanData[$key] = self::cleanString($value);
                    break;
                case 'email':
                    $cleanData[$key] = self::cleanEmail($value);
                    break;
                default:
                    // Si no se especifica un tipo o el tipo no es reconocido, usar limpieza genérica
                    $cleanData[$key] = self::cleanInput($value);
                    break;
            }
        }
        return $cleanData;
    }

    // Método específico para limpiar números enteros
    public static function cleanInt($data)
    {
        $data = trim($data); 
        $data = htmlspecialchars($data);
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    // Método específico para limpiar cadenas (strings)
    public static function cleanString($data)
    {
        $data = trim($data);
         $data = htmlspecialchars($data); 
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    // Método específico para limpiar correos electrónicos
    public static function cleanEmail($data)
    {
        $data = trim($data);
         $data = htmlspecialchars($data); 
        return filter_var($data, FILTER_SANITIZE_EMAIL);
    }
}

// Uso de la clase
// $cleanData = DataSanitizer::cleanInput($_POST['data']);
// $cleanArray = DataSanitizer::cleanArray($_POST);
// $cleanInt = DataSanitizer::cleanInt($_POST['number']);
// $cleanString = DataSanitizer::cleanString($_POST['text']);
// $cleanEmail = DataSanitizer::cleanEmail($_POST['email']);
