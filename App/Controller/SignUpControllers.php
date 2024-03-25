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



class SignUpControllers extends Token
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
   }

   public function sign_up()
   {
      $header = $this->header[1] = "NEVERIA | SIGN-UP";
      
      $Data["sucursales"] = $this->SurcursalModel->Query()->Where("status", "=", 1)->Singlefirst();;
      
      return Utils::view("Auth.sign-up", $Data, $this->header);
   }
   /**SE ENCARGA DE REGISTAR LOS DATOS DEL USUARIO */
   public function Inscribirse()
   {

      $response = [
         'status' => 'Error',
         'titulo' => 'NO REGISTRADO',
         'msg' => 'Surgieron errores al regitrar sus datos',
         'url' => ''
      ];

      $terminos = isset($_POST["terminos"]) ? $_POST["terminos"] : 'off';
      /** ESTOS DATOS VAN PARA LA TABLA USER */
      $DatosUser = [
         "email" => $_POST["email"],
         "dui" => $_POST["dui"],
         "password" => $_POST["contraseña"],
         "telefono" => $_POST["telefono"],
         "id_sucursal" => $_POST["sucursal"],
         "terminos_condiciones" => $terminos
      ];
      /** ESTA LINEA LIMPIA LOS CAMPOS DE CALQUIER INYECCION */
      $DatosUser = $this->antiInyeccion->Limpiar($DatosUser);
      $DatosUser["password"]=$this->Encrypto->encrypt($DatosUser["password"]);
      /** ESTA LINEA INSERTA EL REGISTRO DEL EMPLEADO Y RETORNA EL ID*/
      $duiExiste = $this->UserModel->QueryEspefico(["count(*) as total"])->Where("dui","=",$DatosUser["dui"])->first();
      if($duiExiste[0]["total"]>0){
         $response = [
            'status' => 'info',
            'titulo' => 'NO REGISTRADO',
            'msg' => 'El dui ya esta vinculado a otra cuenta',
            'url' => ''
         ];
         echo json_encode($response);
         return false;
      }

      // if($duiExiste->rowCount>0)
      $Data = $this->UserModel->Insert($DatosUser);
      /** ESTOS DATOS VAN PARA LA TABLA DATOS_USER */
      $DataDatos = [
         "nombre" => $_POST["nombre"],
         "apellidos" => $_POST["apellidos"],
         "id_user" => $Data
      ];
      /** ESTA LINEA LIMPIA LOS CAMPOS DE CALQUIER INYECCION */
      $DataDatos = $this->antiInyeccion->Limpiar($DataDatos);
      /** ESTA LINEA INSERTA EL REGISTRO DEL EMPLEADO Y RETORNA EL ID*/
      $Data1 = $this->DatosUserModel->Insert($DataDatos);
      if (!$Data1 == false) {

         $response = [
            'status' => 'success',
            'titulo' => 'Exito',
            'msg' => 'Registrado correctamente',
            'url' => Utils::url('/Auth/sign-in'),
         ];
      }

      echo json_encode($response);
      return false;
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
