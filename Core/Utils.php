<?php
// este se utiliza para cargar todos los css y js las librerias
namespace Core;

use Core\App;

class Utils
{
    // este se utiliza para los enlaces o redireciones en las view 
    static function url($path =  "")
    {
        $url = App::getPath() . $path;
        $url = preg_replace('#/+#', '/', $url);
        return $url;
    }
    // y este se encarga de cargar las view del sistema
    static function assets($path = "")
    {
        $url = App::getPath() . "/Resources/Assets/{$path}";
        $url = preg_replace('#/+#', '/', $url);
        return $url;
    }

    // Esta carga la view unicas que no tienen vista internas 
    static function view($path = "", $data = [] ,$header)
    {
        // instancie la clase aqui para tener acceso a sus clases assets
        $utils = new Utils();
        $url = "./Resources/Views/";
       $path = str_replace(".", "/", $path);
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        
        // $content = "";
        // $content .= require_once  $url . "Partials/Header.php";
        // $content .=  require_once $url . '' . $path . ".php";
        // $content .= require_once  $url . "Partials/Footer.php";
        return require_once $url . '' . $path . ".php";;
    }
    static function viewChat($path = "", $data = [])
    {
        // instancie la clase aqui para tener acceso a sus clases assets
        $utils = new Utils();
        $url = "./Resources/Views/";
        // $path = str_replace(".", "/", $path);
        $path = explode('.', $path);
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        
        $content = "";
        $content .= require_once  $url . "Partials/Header.php";
        $content .= require_once  $url . "".$path[0]."/".$path[1].".php";
        $content .=  require_once $url . '' . $path[0]."/".$path[2]. "/".$path[3].".php";
        $content .= require_once  $url . "Partials/Footer.php";
        return $content;
    }
    static function viewStatic($path = "", $data = [])
    {
        // instancie la clase aqui para tener acceso a sus clases assets
        $utils = new Utils();
        $url = "./Resources/Views/";
        $path = explode('.', $path);
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        $content = "";
        $content .= require_once  $url . $path[0]."/Partials/Header.php";
        $content .=  require_once $url . '' . $path[0] ."/".$path[1]. ".php";
        $content .= require_once  $url . $path[0]."/Partials/Footer.php";
        return $content;
    }

    
    // Este cargar la views que tiene vistas internas
    static function viewDasboard($path = "", $data = [],$alerta)
    {
       // instancie la clase aqui para tener acceso a sus clases assets
        $utils = new Utils();
        $url = "./Resources/Views/";
        $path = explode('.', $path);
        $msg=$alerta;
        // $path = str_replace(".","/",$path);
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        
        $content = "";
        $content .= require_once  $url . "Partials/Header.php";
        // $content .= require_once  $url . "" . $path[0] . "/Partes/Panel.php";
        // // $content .= require_once  $url . "" . $path[0] . "/partes/".$_SESSION[""].".php";
        // $content .= require_once  $url . "" . $path[0] . "/" .$_SESSION['datosUser']['rol']."Views/" . $path[1] .".php" 
        // ?? require_once  $url . "" . $path[0] . "/Error.php";
        // $content .= require_once  $url . "" . $path[0] . "/partes/panelF.php";
        $content .= require_once  $url . "Partials/Footer.php";
        
        return $content;
    }
}
