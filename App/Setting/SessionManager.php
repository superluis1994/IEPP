<?php
namespace app\Setting;

class SessionManager
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Iniciar sesión si aún no ha sido iniciada
        }
    }

    // Iniciar sesión del usuario
    static function loginUser(array $userData)
    {
        // Inicializar 'datos' solo si aún no está establecido
    if (!isset($_SESSION['datos'])) {
        $_SESSION['datos'] = [];
    }

    // Agregar o actualizar los valores en 'datos' sin sobrescribir los existentes innecesariamente
    foreach ($userData as $key => $value) {
        $_SESSION["datos"][$key] = $value;
    }
    }

    // Verificar si el usuario está logueado
    static function isUserLoggedIn()
    {
        return isset($_SESSION['datos']);
    }

    // Obtener datos del usuario desde la sesión
    static function getUserData($key)
    {
        return $_SESSION[$key] ?? null; // Devuelve null si la clave no existe
    }

    // Cerrar la sesión del usuario
    static function logoutUser()
    {
        // session_unset(); // Eliminar todas las variables de sesión
        // session_destroy(); // Destruir la sesión

        if (session_status() == PHP_SESSION_ACTIVE) {
            session_unset(); // Eliminar todas las variables de sesión
            session_destroy(); // Destruir la sesión
            return true; // Retornar verdadero si la sesión se cerró
        }
        return false; // Retornar falso si la sesión no estaba activa o no se pudo cerrar
    }
}
