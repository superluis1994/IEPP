<?php

namespace App\Controller;

use Core\Utils;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Setting\Token;
use App\Models\UserModel;
use App\Models\DatosUserModel;
use App\Setting\Encryptar;
use App\Setting\AuthValidar;

class IngresosCotrollers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private DatosUserModel $DatosUserModel;
   private Encryptar $Encrypto;
   public function __construct()
   {
      $this->header[1] = "Auth";
      $this->UserModel = new UserModel;
      $this->DatosUserModel = new DatosUserModel;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);     

   }
   public function index()
   {
      $header = $this->header[1] = "NEVERIA | PANEL";
      // unset($_SESSION["datosUser"]);
      // setcookie('Auth', '', 0, '/'); // Se elimina inmediatamente
      return Utils::viewPanel("Empleado.Home", $data = [], $this->header);
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
