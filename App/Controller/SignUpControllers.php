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
use App\Models\DirectivaModel;
use App\Setting\AuthValidar;



class SignUpControllers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private Encryptar $Encrypto;
   private DirectivaModel $Directiva;
   private AntiInyeciones $inyecciones;
   public function __construct()
   {
      $this->UserModel = new UserModel;
      $this->inyecciones = new AntiInyeciones;
      $this->Directiva = new DirectivaModel;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
   }
   public function home()
   {
      if(SessionManager::isUserLoggedIn()){
         header('Location:'.Utils::url("/panel"));
         exit;
      }
      $selectDirectiva= $this->Directiva->getAll("ACTIVO");
      
      $data=[
         "status"=>"success",
         "icono"=>Utils::assets('Img/auth/ico.png'),
         "titulo"=>"IEPP | SIGN-UP",
         "selected"=>$selectDirectiva,
         "url"=>[
            "form"=>Utils::url('/SignUp/Registrarse'),
         ]
      ];
      return Utils::view("Auth.sign-up", $data, $this->header);
   }
   /**SE ENCARGA DE REGISTAR LOS DATOS DEL HERMANOS */
   public function Registrarse()
   {
      $response = [
         'status' => 'error',
         'titulo' => 'Error',
         'msg' => 'comuniquese con el administrador error 500',
         'url' => Utils::url('/Auth/sign-in'),
         "data" =>$_POST["nombre"]
      ];
      
      $datos=$_POST;
      // $this->UserModel->findByDui($datos["dui"]);
      if ($this->UserModel->findByDui($datos["dui"])) {
         $response = [
            'status' => 'error',
            'titulo' => 'NO REGISTRADO',
            'msg' => 'El Dui ya esta registrado, utilice otro Dui',
            'url' => ''
         ];
         echo json_encode( $response);
         exit;
           } 

      $estructuraDatos = [
         "nombre" => "string",
         "apellidos" => "string",
         "email" => "email",
         "dui" => "string",
         "contraseña" => "string",
         "telefono" => "string",
         "directiva" => "int",
         "terminos" => "bool"
     ];
      $datosCombinados = [];

      foreach ($datos as $clave => $valor) {
          $datosCombinados[$clave] = [
              'value' => $valor,
              'type' => $estructuraDatos[$clave] ?? 'string' // Suponer string por defecto
          ];
      }
      $DatosFiltrados=$this->inyecciones->cleanDataArray($datosCombinados);
      
      // $permisosJson = file_get_contents('../Setting/permisos_roles.json');
      // $permisosJson = file_get_contents(__DIR__ . '/../../Setting/permisos_roles.json');
      // $permisosJson = file_get_contents(__DIR__ . '/../../Setting/permisos_roles.json');
      $permisosJson = file_get_contents(__DIR__ . '/../Setting/permisos_roles.json');


      $permisosRoles = json_decode($permisosJson, true);
      $permisos = $permisosRoles["directivo"];

       if($this->UserModel->createUsuario($DatosFiltrados,$permisos,2)){

          $response = [
             'status' => 'success',
             'titulo' => 'Exito',
             'msg' => 'Registrado correctamente',
             'url' => Utils::url('/Auth'),
             "data" =>$_POST["nombre"]
          ];
       }
      

      echo json_encode($response);
      return false;
   }
   /**SE ENCARGA DE REGISTAR LOS DATOS DEL DIRECTIVO */
   public function RegistrarDirectivo()
   {
      $response = [
         'status' => 'error',
         'titulo' => 'Error',
         'msg' => 'comuniquese con el administrador error 500',
         'url' => Utils::url('/Auth/sign-in'),
         "data" =>$_POST["nombre"]
      ];
      
      $datos=$_POST;
      // $this->UserModel->findByDui($datos["dui"]);
      if ($this->UserModel->findByDui($datos["dui"])) {
         $response = [
            'status' => 'error',
            'titulo' => 'NO REGISTRADO',
            'msg' => 'El Dui ya esta registrado, utilice otro Dui',
            'url' => ''
         ];
         echo json_encode( $response);
         exit;
           } 

      $estructuraDatos = [
         "nombre" => "string",
         "apellidos" => "string",
         "email" => "email",
         "dui" => "string",
         "contraseña" => "string",
         "telefono" => "string",
         "terminos" => "bool"
     ];
      $datosCombinados = [];

      foreach ($datos as $clave => $valor) {
          $datosCombinados[$clave] = [
              'value' => $valor,
              'type' => $estructuraDatos[$clave] ?? 'string' // Suponer string por defecto
          ];
      }
      $DatosFiltrados=$this->inyecciones->cleanDataArray($datosCombinados);
      
       if($this->UserModel->createUsuario($DatosFiltrados)){

          $response = [
             'status' => 'success',
             'titulo' => 'Exito',
             'msg' => 'Registrado correctamente',
             'url' => Utils::url('/Auth'),
             "data" =>$_POST["nombre"]
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
