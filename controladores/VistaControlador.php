<?php
require_once "modelos/ModeloVistas.php";

class VistaControlador extends ModeloVistas
{

//controlador para obtener plantilla

    public function obtener_plantilla_controlador()
    {

        return require_once "./vistas/plantillas.php";
    }

//controlador para obtener vistas

    public function obtener_vistas_controlador()
    {

        if (isset($_GET['url'])) {
            $ruta = explode("/", $_GET['url']);
            $listaMenu = ["admin", "usuario"];

            if (in_array($ruta[0], $listaMenu)) {

                if (@$ruta[1] == "") {
                    $vista = "home";
                    $respuesta = ModeloVistas::obtener_vista_modelo($ruta[0], $vista);

                } else {
                    $respuesta = ModeloVistas::obtener_vista_modelo($ruta[0], $ruta[1]);
                }

            } else {

                switch ($ruta[0]) {
                    case "installer":$respuesta = "installer";
                        break;

                    default:$respuesta = "login";
                        break;
                }
            }
        } else {
            $respuesta = "login";
        }
        return $respuesta;
    }

}
