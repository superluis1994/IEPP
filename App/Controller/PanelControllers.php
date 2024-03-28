<?php

namespace App\Controller;

use Core\Utils;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Setting\Token;
use App\Models\UserModel;
use App\Models\DatosUserModel;
use App\Models\SucursalesModel;
use App\Setting\Encryptar;
use App\Setting\AntiInyection;
use App\Setting\AuthValidar;



class PanelControllers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private DatosUserModel $DatosUserModel;
   private SucursalesModel $SurcursalModel;
   private Encryptar $Encrypto;
   private AntiInyection $antiInyeccion;
   public function __construct()
   {
      $this->header[1] = "Auth";
      $this->UserModel = new UserModel;
      $this->DatosUserModel = new DatosUserModel;
      $this->SurcursalModel = new SucursalesModel;
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
      $header = $this->header[1] = "IEPP | PANEL";
      // unset($_SESSION["datosUser"]);
      // setcookie('Auth', '', 0, '/'); // Se elimina inmediatamente

      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.home", $data = [], $this->header);
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
