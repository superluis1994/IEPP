<?php

namespace App\Controller;

use Core\Utils;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Setting\Token;
use App\Models\UserModel;
use App\Setting\Encryptar;
use App\Setting\AntiInyeciones;
use App\Setting\SessionManager;
use App\Setting\AuthValidar;



class SignInControllers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private Encryptar $Encrypto;
   private AntiInyeciones $inyecciones;
   public function __construct()
   {
     
      $this->UserModel = new UserModel;
      $this->inyecciones = new AntiInyeciones;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
    
   }
   public function sign_in()
   { 
   
      if(SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/panel"));
         exit;
      }

      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/auth/ico.png'),
         "titulo"=>"IEPP | SIGN-IN",
         "url"=>[
            "form"=>Utils::url('/Auth/acceder'),
            "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      return Utils::view("Auth.sign-in", $data, $this->header);
   }

   /**SE ENCARGA DE CARGAR DE VALIDAR LOS DATOS DE INICIO DE SESION */
   public function Acceder()
   {
      $response = [
         "status"=>"error",
         'titulo' => 'Datos incorrectos',
         'msg' => 'Los datos no coinciden con ningun registro',
         'url' => "",
         "data" =>""
      ];

        $dui = $this->inyecciones->cleanString($_POST['dui']);
       $FrondPassword = $this->inyecciones->cleanString($_POST['password']);
      $respuesta = $this->UserModel->validateUser(["usuario"=>$dui]);
      @$Dbpasword= $this->Encrypto->decrypt($respuesta[0]["passwor"]);
      
      if(count($respuesta)>0){
          if($FrondPassword == $Dbpasword){
             if($respuesta[0]["tipoUser"] == "Directivo"){
                $respuesta = $this->UserModel->datosUser(["usuario"=>$dui]);
               //  echo  var_dump($respuesta);
                SessionManager::loginUser($respuesta);

            }else{
               SessionManager::loginUser($respuesta);
            }

            $response = [
               "status"=>"success",
               'titulo' => 'Datos correctos',
               'msg' => 'En unos segundos sera redireccionado',
               'url' => Utils::url('/panel/home'),
            ];
         }else{
            $response = [
               "status"=>"error",
               'titulo' => 'Contraseña incorrecta',
               'msg' => 'La contraseña no coincide con sus datos',
               'url' => ""
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
