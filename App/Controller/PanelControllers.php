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
use App\Models\EntradasModel;
use App\Setting\AuthValidar;



class PanelControllers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private DatosUserModel $DatosUserModel;
   private EntradasModel $EntradasModel;
   private Encryptar $Encrypto;

   public function __construct()
   {
      $this->header[1] = "Auth";
      $this->EntradasModel = new EntradasModel;
      $this->UserModel = new UserModel;
      $this->DatosUserModel = new DatosUserModel;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
   }
   public function home()
   {
     
      if(!SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/Auth"));
         exit;
      }
      if($_SESSION["datos"][0]["tipoUser"] == "Cristiano"){
         SessionManager::logoutUser();
         return Utils::view("Error.maintenance", $data=[], $this->header);
        exit;
      }

      $select=$this->EntradasModel->getAll();
      
      $assoctData = new TransaccionesModel();
      $assoctData=$assoctData->totales();
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/panel/cpanel.svg'),
         "titulo"=>"PANEL | Home",
         "select"=>$select,
         "data"=>$assoctData,
         "url"=>[
            "regitroEntrada"=>Utils::url('/panel/entrada/add'),
            "regitroSalida"=>Utils::url('/panel/salida/add'),
            "cerrarSesion"=>Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      $header = $this->header[1] = "IEPP | PANEL";
      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.home", $data, $this->header);
   }
   public function addEntrada()
   {
     
      // if(!SessionManager::isUserLoggedIn()){
      //    header('Location:'.Utils::url("/Auth"));
      //    exit;
      // }
      // if($_SESSION["datos"][0]["tipoUser"] == "Cristiano"){
      //    SessionManager::logoutUser();
      //    return Utils::view("Error.maintenance", $data=[], $this->header);
      //   exit;
      // }

      // $select=$this->EntradasModel->getAll();
      
      // $assoctData = new TransaccionesModel();
      // $assoctData=$assoctData->totales();
      // $data=[
      //    "status"=>"success",
      //    "icono"=>Utils::assets('Img/panel/cpanel.svg'),
      //    "titulo"=>"PANEL | Home",
      //    "select"=>$select,
      //    "data"=>$assoctData,
      //    "url"=>[
      //       "regitroEntrada"=>Utils::url('panel/entrada/add'),
      //       "regitroSalida"=>Utils::url('panel/salida/add'),
      //       "cerrarSesion"=>Utils::url('/panel/salir'),
      //       // "resetPassword"=>Utils::url('/Auth/reset')
      //    ]
      // ];
 
         $response = [
            "status"=>"success",
            'titulo' => 'correcto',
            'msg' => 'Regitro agregado',
            'url' => Utils::url('/Auth'),
         ];


      echo json_encode($response);
   
   }

   /** CERRAR SESSION DEL USUARIO */
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
