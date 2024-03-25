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
    public static function cleanArray($dataArray)
    {
        $cleanData = [];
        foreach ($dataArray as $key => $value) {
            // Limpia cada valor del array utilizando cleanInput
            $cleanData[$key] = self::cleanInput($value);
        }
        return $cleanData;
    }

    // Método específico para limpiar números enteros
    public static function cleanInt($data)
    {
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    // Método específico para limpiar cadenas (strings)
    public static function cleanString($data)
    {
        return filter_var($data, FILTER_SANITIZE_STRING);
    }

    // Método específico para limpiar correos electrónicos
    public static function cleanEmail($data)
    {
        return filter_var($data, FILTER_SANITIZE_EMAIL);
    }
}

// Uso de la clase
// $cleanData = DataSanitizer::cleanInput($_POST['data']);
// $cleanArray = DataSanitizer::cleanArray($_POST);
// $cleanInt = DataSanitizer::cleanInt($_POST['number']);
// $cleanString = DataSanitizer::cleanString($_POST['text']);
// $cleanEmail = DataSanitizer::cleanEmail($_POST['email']);
