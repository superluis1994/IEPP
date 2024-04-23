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
use App\Setting\AntiInyeciones;
use App\Setting\AuthValidar;



class PanelControllers extends Token
{
   private $header = [];
   private UserModel $UserModel;
   private DatosUserModel $DatosUserModel;
   private EntradasModel $EntradasModel;
   private Encryptar $Encrypto;
   private AntiInyeciones $inyecciones;
   private TransaccionesModel $transaccionesModel;

   public function __construct()
   {
      $this->header[1] = "Auth";
      $this->EntradasModel = new EntradasModel;
      $this->UserModel = new UserModel;
      $this->DatosUserModel = new DatosUserModel;
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);
      $this->inyecciones = new AntiInyeciones;
      $this->transaccionesModel= new TransaccionesModel;
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
         "posicion"=>"HOME",
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
      $response = [
         "status"=>"error",
         'titulo' => 'Error',
         'msg' => 'No se pudo realizar el regitro',
         'data'=>"",
         'url' => ""
       ];
     
      if(!SessionManager::isUserLoggedIn()){
     
         $response = [
            "status" => "error", // Puede ser "error", "fail" o un código específico que signifique no autenticado
            "titulo" => "No autenticado",
            "msg" => "No tienes permiso para realizar esta acción. Por favor, inicia sesión.",
            "url" => Utils::url('/Auth')
         ];
         exit;
      }
      
         $estructuraDatos = [
            "tipoEntrada" => "int",
            "cantidad" => "decimal",
            "comentario" => "string",
        ];
        $dataSanitizada=[];
        $dataSanitizada=$this->inyecciones->LimpiarForm($_POST,$estructuraDatos);
        $dataInsert=[
            "monto"=>$dataSanitizada["cantidad"],
            "id_realizada_por"=>$_SESSION["datos"][0]["id"],
            "id_tipo_transacion"=>1,
            "id_tipo_entrada"=>$dataSanitizada["tipoEntrada"],
            "id_directiva"=>$_SESSION["datos"][0]["id_directiva"],
            "comentario"=>$dataSanitizada["comentario"],
            "usuario_creacion"=>$_SESSION["datos"][0]["id"]

        ];
        
           if($this->transaccionesModel->create($dataInsert))
           {

              $response = [
                 "status"=>"success",
                 'titulo' => 'correcto',
                 'msg' => 'Entrada Registrada',
                 'data'=>$dataSanitizada,
                 'url' => Utils::url('/Auth'),
               ];
            }

 


      echo json_encode($response);
   
   }
 public function addSalida()
      {
      $response = [
         "status"=>"error",
         'titulo' => 'Error',
         'msg' => 'No se pudo realizar el regitro',
         'data'=>"",
         'url' => ""
       ];
     
      if(!SessionManager::isUserLoggedIn()){
     
         $response = [
            "status" => "error", // Puede ser "error", "fail" o un código específico que signifique no autenticado
            "titulo" => "No autenticado",
            "msg" => "No tienes permiso para realizar esta acción. Por favor, inicia sesión.",
            "url" => Utils::url('/Auth')
         ];
         exit;
      }
      
         $estructuraDatos = [
            "tipoSalida" => "int",
            "cantidad" => "decimal",
            "comentario" => "string",
        ];
        $dataSanitizada=[];
        $dataSanitizada=$this->inyecciones->LimpiarForm($_POST,$estructuraDatos);
        $dataInsert=[
            "monto"=>$dataSanitizada["cantidad"],
            "comentario"=>$dataSanitizada["comentario"],
            "id_realizada_por"=>$_SESSION["datos"][0]["id"],
            "id_tipo_transacion"=>2,
            "id_tipo_entrada"=>$dataSanitizada["tipoSalida"],
            "id_directiva"=>$_SESSION["datos"][0]["id_directiva"],
            "usuario_creacion"=>$_SESSION["datos"][0]["id"]

         ];
         //   :monto, :comentario, :idRealizadaPor, :idTipoTransaccion, :idTipoEntrada, :idDirectiva, :usuarioCreacion, 
         $result=$this->transaccionesModel->salidaDinero($dataInsert);
           if($result["transaccionExitosa"]==1)
           {

              $response = [
                 "status"=>"success",
                 'titulo' => 'correcto',
                 'msg' => 'Salida registrada',
                 'data'=>$dataSanitizada,
                 'url' => Utils::url('/Auth'),
               ];
            }else{
               $response = [
                  "status" => "error", // Puede ser "error", "fail" o un código específico que signifique no autenticado
                  "titulo" => "No se realizo",
                  "msg" => "No tiene los fondos suficientes para la salida.",
                  "url" => Utils::url('/Auth')
               ];
            }
 


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
