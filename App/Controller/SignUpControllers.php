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



class SignUpControllers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private Encryptar $Encrypto;
   private AntiInyeciones $inyecciones;
   public function __construct()
   {
      $this->UserModel = new UserModel;
      // $this->inyecciones = new AntiInyeciones;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
   }
   public function home()
   {
      if(SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/panel"));
         exit;
      }
      
      
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/auth/ico.png'),
         "titulo"=>"IEPP | SIGN-UP",
         "url"=>[
            "form"=>Utils::url('/SignUp/Registrarse'),
         ]
      ];
      return Utils::view("Auth.sign-up", $data, $this->header);
   }
   /**SE ENCARGA DE REGISTAR LOS DATOS DEL USUARIO */
   public function Registrarse()
   {

      // $response = [
      //    'status' => 'Error',
      //    'titulo' => 'NO REGISTRADO',
      //    'msg' => 'Surgieron errores al regitrar sus datos',
      //    'url' => ''
      // ];

     
         $response = [
            'status' => 'success',
            'titulo' => 'Exito',
            'msg' => 'Registrado correctamente',
            'url' => Utils::url('/Auth/sign-in'),
            "data" =>$_POST["nombre"]
         ];
      

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
