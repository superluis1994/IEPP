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



class SignInControllers extends Token
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
      // echo $this->Encrypto->decrypt('DmNwbDBMemgMrSN9wbqlff3xDrqh3RTQEoKAjgTgOag=');
      // echo $this->Encrypto->encryptItem('1234');
      // echo var_dump($_SESSION["datosUser"]);
      // echo "<br>";
      //    echo var_dump(json_decode($_COOKIE['Auth'], true)); 

   }
   public function sign_in()
   { 
      $header = $this->header[1] = "NEVERIA | SIGN-IN";
      // unset($_SESSION["datosUser"]);

      // setcookie('Auth', '', 0, '/'); // Se elimina inmediatamente
      // if (isset($_COOKIE['Auth'])) {
   
      //    // echo var_dump(json_decode($_COOKIE['Auth'], true));
      //    header("Location:" . Utils::url('/Panel'));
      // }
      return Utils::view("Auth.sign-in", $data = [], $this->header);
   }

   /**SE ENCARGA DE CARGAR DE VALIDAR LOS DATOS DE INICIO DE SESION */
   public function Acceder()
   {
      $response = [
         'status' => 'info',
         'titulo' => 'Datos incorrectos',
         'msg' => 'Los datos no coinciden con ningun registro',
         'url' => "",
         "data" => ""
      ];

      $Data = [
         "dui" => $_POST["dui"],
         "password" => $_POST["password"],
      ];
// echo var_dump($Data);
      $Data = $this->antiInyeccion->Limpiar($Data);
      @$userData = $this->UserModel
      ->QueryEspefico([
         "user.id_user as id", "data_user.nombre as nombre","data_user.apellidos",
         "user.dui as Dui","user.password as password", "sucursal.nombre as sucursal","user.rol","estado.nombre as estado"
         ])
         ->MultJoin([
            ["tablaPk" => "user", "pk" => "id_user", "tablaFk" => "data_user", "fk" => "id_user"],
            ["tablaPk" => "user", "pk" => "id_sucursal", "tablaFk" => "sucursal", "fk" => "id_sucursal"],
            ["tablaPk" => "user", "pk" => "status", "tablaFk" => "estado", "fk" => "id_status"],    
            ])
            ->Mult_Where([
            [
               "atributo" => "user.dui", "condicion" => "=",
               "value" => $Data['dui'], "operador" => ""
               ]
               ])->first();
                
            
      // print_r($userData);
      if($userData != null){
         
      //   $passwordDecrypt=$this->Encrypto->decrypt($userData[0]["password"]);
      if($this->Encrypto->decrypt($userData[0]["password"]) == $Data["password"]){
         if(isset($_POST["cookie"]) && @$_POST["cookie"]=="on"){

            $array = ["dui"=>$userData[0]["Dui"],'empleado' => $userData[0]["nombre"], 'password' =>$userData[0]["password"]];
            setcookie('Auth', json_encode($array), time() + (60 * 60 * 24 * 30), '/'); // 30 días

         }
            @$_SESSION['datosUser'];
            $datos['id'] = $this->Encrypto->encrypt($userData[0]['id']);
            $datos['user'] = $userData[0]['nombre'];
            $datos['status'] = $userData[0]['estado'];
            $datos['rol'] = $userData[0]['rol'];
            $_SESSION['datosUser'] = $datos;
           

              $response = [
                 'status' => 'success',
                 'titulo' => 'Exito',
                 'msg' => 'En breves segundos sera redireccionado',
                 'url' => Utils::url('/panel'),
                 "data" => $Data
              ];
            }

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
