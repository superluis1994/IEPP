<?php

namespace App\Controller;

use Core\Utils;
// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;
// use App\Setting\Token;
use App\Models\TalentoModel;
use App\Setting\Encryptar;
use App\Setting\SessionManager;
use App\Models\TransaccionesModel;
use App\Setting\AuthValidar;
use App\Setting\MenuBuilder;
use App\Setting\Paginacion;


class TalentoControllers 
{
   private $header = [];
   private MenuBuilder $Menu;
   private TalentoModel $talentoModel;
   private Encryptar $Encrypto;
   private $paginas;
   private $limited;
   public function __construct()
   {
      /** CREAR UNA INSTANCIA DE LOS OBJETOS */
      $this->header[1] = "Talento";
      $this->paginas = 10;
      $this->limited =2;
      $this->Menu = new MenuBuilder();
      $this->talentoModel = new TalentoModel();
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);

      // echo var_dump($_SESSION["datos"]);
   }
   public function home()
   {
      /** VALIDACION SI EL USUARIO ESTA LOGUEADO O SI NO REDIRECCIONA */
      if (!SessionManager::isUserLoggedIn()) {
         header('Location:' . Utils::url("/Auth"));
         exit;
      }
     
      /** GENERAR EL HTML DEL MENÚ */
      $menuHtml = $this->Menu->buildMenu();

     /** OBTENER LOS REGITROS DE LOS TALENTOS */
       $GetRegistros=$this->talentoModel->getAll($_SESSION["datos"][0]["id_directiva"]);
       $paginacion =  new Paginacion(count($GetRegistros), $this->limited, $this->paginas, 1, "");
       $pag = $paginacion->createLink("pagination justify-content-center");
      //  echo var_dump($GetRegistros);
       
      /** GENERO LA RESPUESTA DEL FETCH DEL JS EN JSONG */
      $data = [
         "status" => "success",
         "icono" => Utils::assets('Img/panel/cpanel.svg'),
         "titulo" => "PANEL | Home",
         "menu" => $menuHtml,
         "data" => $GetRegistros,
         "paginacion"=>$pag,
         "url" => [
            "cerrarSesion" => Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.talento", $data);
   }
   public function Busqueda()
   {

      
      /** VALIDACION SI EL USUARIO ESTA LOGUEADO O SI NO REDIRECCIONA */
      if (!SessionManager::isUserLoggedIn()) {
         header('Location:' . Utils::url("/Auth"));
         exit;
      }
   
     
      /** GENERAR EL HTML DEL MENÚ */
      $menuHtml = $this->Menu->buildMenu();

     /** OBTENER LOS REGITROS DE LOS TALENTOS */
       $GetRegistros=$this->talentoModel->getAll($_SESSION["datos"][0]["id_directiva"]);
       $paginacion =  new Paginacion(count($GetRegistros), $this->limited, $this->paginas, 1, "");
       $pag = $paginacion->createLink("pagination justify-content-center");
      //  echo var_dump($GetRegistros);
       
      /** GENERO LA RESPUESTA DEL FETCH DEL JS EN JSONG */
      $data = [
         "status" => "success",
         "icono" => Utils::assets('Img/panel/cpanel.svg'),
         "titulo" => "PANEL | Home",
         "menu" => $menuHtml,
         "data" => $GetRegistros,
         "paginacion"=>$pag,
         "url" => [
            "cerrarSesion" => Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.talento", $data);
   }
 

   /**CERRAR SESSION DEL USUARIO */
   public function cerrarSesion()
   {
      $response = [
         "status" => "error",
         'titulo' => 'Sesión no cerrada',
         'msg' => 'por problemas internos no se cerro la sesion',
         'url' => Utils::url(''),
      ];

      if (SessionManager::logoutUser()) {
         $response = [
            "status" => "success",
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
