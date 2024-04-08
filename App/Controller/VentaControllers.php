<?php

namespace App\Controller;

use Core\Utils;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Setting\Token;
use App\Models\UserModel;
use App\Models\DatosUserModel;
use App\Setting\Encryptar;
use App\Setting\AntiInyection;
use App\Setting\SessionManager;
use App\Models\TransaccionesModel;
use App\Setting\AuthValidar;
use App\Setting\MenuBuilder;


class VentaControllers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private DatosUserModel $DatosUserModel;

   private Encryptar $Encrypto;
   private AntiInyection $antiInyeccion;
   public function __construct()
   {
      $this->header[1] = "Auth";
      $this->UserModel = new UserModel;
      $this->DatosUserModel = new DatosUserModel;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
      $this->antiInyeccion = new AntiInyection;
      //  AuthValidar::Cookies();
      // if (!isset($_COOKIE['Auth'])) {
      //    // echo var_dump(json_decode($_COOKIE['Auth'], true));
      //    header("Location:" . Utils::url('Auth/sign-in'));
      // }
         // echo var_dump(json_decode($_COOKIE['Auth'], true));
         // echo var_dump($_SESSION["datos"]);
         // session_destroy();
   }
   public function home()
   {
      if(!SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/Auth"));
         exit;
      }
      
      // Crear una instancia de MenuBuilder
$menu = new MenuBuilder();

// Generar el HTML del menú
$menuHtml = $menu->buildMenu();

// Supongamos que $items_menu obtiene los datos de la base de datos como se muestra en tu captura de pantalla.

// Crear una instancia de MenuBuilder y construir el menú
      
      $assoctData = new TransaccionesModel();
      $assoctData=$assoctData->totales();
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/panel/cpanel.svg'),
         "titulo"=>"PANEL | Home",
         "menu"=>$menuHtml,
         "data"=>$assoctData,
         "url"=>[
            "cerrarSesion"=>Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      $header = $this->header[1] = "IEPP | PANEL";
      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.venta", $data, $this->header);
   }
   public function home2()
   {
      if(!SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/Auth"));
         exit;
      }
      
      // Crear una instancia de MenuBuilder
$menu = new MenuBuilder();

// Generar el HTML del menú
$menuHtml = $menu->buildMenu();

// Supongamos que $items_menu obtiene los datos de la base de datos como se muestra en tu captura de pantalla.

// Crear una instancia de MenuBuilder y construir el menú
      
      $assoctData = new TransaccionesModel();
      $assoctData=$assoctData->totales();
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/panel/cpanel.svg'),
         "titulo"=>"PANEL | Home",
         "menu"=>$menuHtml,
         "data"=>$assoctData,
         "url"=>[
            "cerrarSesion"=>Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      $header = $this->header[1] = "IEPP | PANEL";
      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.home", $data, $this->header);
   }

   /**CERRAR SESSION DEL USUARIO */
   public function cerrarSesion()
   {
      $response = [
         "status"=>"error",
         'titulo' => 'Sesión no cerrada',
         'msg' => 'por problemas internos no se cerro la sesion',
         'url' => Utils::url(''),
      ];
      
      if(SessionManager::logoutUser()){
         $response = [
            "status"=>"success",
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
