<?php

namespace App\Controller;

use Core\Utils;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Setting\Token;
use App\Models\UserModel;
use App\Models\DatosUserModel;
use App\Setting\Encryptar;
use App\Setting\SessionManager;
use App\Models\TransaccionesModel;
use App\Setting\AuthValidar;
use App\Setting\MenuBuilder;


class VentaControllers extends Token
{
   private $header = [];
   private MenuBuilder $Menu;

   private Encryptar $Encrypto;
   public function __construct()
   {
      $this->header[1] = "Auth";
      $this->Menu = new MenuBuilder();

   }
   public function home()
   {
      if (!SessionManager::isUserLoggedIn()) {
         header('Location:' . Utils::url("/Auth"));
         exit;
      }
 
      // Generar el HTML del menú
      $menuHtml = $this->Menu->buildMenu();

         /** GENERO LA RESPUESTA DEL FETCH DEL JS EN JSONG */
      $data = [
         "status" => "success",
         "icono" => Utils::assets('Img/panel/cpanel.svg'),
         "titulo" => "PANEL | VENTAS",
         "menu" => $menuHtml,
         "data" => "",
         "url" => [
            "cerrarSesion" => Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.venta", $data);
   }

   /**CERRAR SESSION DEL USUARIO */
   public function cerrarSesion()
   {
      $response = [
         "status" => "error",
         'titulo' => 'Sesión no cerrada',
         'msg' => 'por problemas internos no se cerro la sesion',
         'url' => Utils::url(''),
      ];

      if (SessionManager::logoutUser()) {
         $response = [
            "status" => "success",
            'titulo' => 'Sesión cerrada',
            'msg' => 'presione ok',
            'url' => Utils::url('/Auth'),
         ];
      }

      echo json_encode($response);
   }
   /**SE ENCARGA DE CARGAR LOS DATOS */
   public function loadMsg()
   {
   }
   /**SE ENCARGA DE GESTIONAR CONSULTAS FETCH */
   public function questionMsg()
   {
   }
}
