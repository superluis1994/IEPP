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
use Detection\MobileDetect;



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
      $this->paginas = 6;
      $this->limited =6;
      $this->Menu = new MenuBuilder();
      $this->talentoModel = new TalentoModel();
      $this->Encrypto = new Encryptar($_ENV["JWT_SECRET_KEY"]);

    // Crear una instancia de Mobile_Detect
         $detect = new MobileDetect;

         // Uso de los métodos de Mobile_Detect para detectar dispositivos
         if ($detect->isMobile() || $detect->isTablet()) {
            $this->limited = 6;
            $this->paginas = 6;
         } 
         // elseif ($detect->isTablet()) {
         //    echo "Accedido desde una tablet.";
         // } else {
         //    echo "Accedido desde un PC o un dispositivo no móvil.";
         // }
      // echo var_dump($_SESSION["datos"]);
   }
   public function home()
   {
      $Tipo=1;
      /** VALIDACION SI EL USUARIO ESTA LOGUEADO O SI NO REDIRECCIONA */
      if (!SessionManager::isUserLoggedIn()) {
         header('Location:' . Utils::url("/Auth"));
         exit;
      }
   

     /** OBTENER LOS REGITROS DE LOS TALENTOS */
       $GetRegistros=$this->talentoModel->getAll($_SESSION["datos"][0]["id_directiva"],$Tipo,NULL,$this->limited);
       $count=$this->talentoModel->getAllCount($_SESSION["datos"][0]["id_directiva"],$Tipo);
       $paginacion =  new Paginacion($count[0]["total"], $this->limited, $this->paginas, 1, "");
       $pag = $paginacion->createLink("pagination justify-content-center");
      //  echo var_dump($GetRegistros);
       
      /** GENERO LA RESPUESTA DEL FETCH DEL JS EN JSONG */
      $data = [
         "status" => "success",
         "icono" => Utils::assets('Img/panel/cpanel.svg'),
         "titulo" => "PANEL | Home",
         "posicion"=>"TALENTO",
         "data" => $GetRegistros,
         "paginacion"=>$pag,
         "trasaccionTipo"=>$Tipo,
         "url" => [
            "trasaccion" => Utils::url('/panel/adm/talento/paginacion'),
            "cerrarSesion" => Utils::url('/panel/salir'),
            // "resetPassword"=>Utils::url('/Auth/reset')
         ]
      ];
      return Utils::viewPanel("Panel.{$_SESSION['datos'][0]['tipoUser']}.talento", $data);
   }
   public function paginacion($pag){

   echo $pag;
     
   }
   public function Busqueda()
   {
      $Tipo=1;
      
      /** VALIDACION SI EL USUARIO ESTA LOGUEADO O SI NO REDIRECCIONA */
      if (!SessionManager::isUserLoggedIn()) {
         header('Location:' . Utils::url("/Auth"));
         exit;
      }
      if(isset($_POST["Tipo"])) {
         $Tipo=$_POST["Tipo"];
      }

     /** OBTENER LOS REGITROS DE LOS TALENTOS */
       $GetRegistros=$this->talentoModel->getAll($_SESSION["datos"][0]["id_directiva"],NULL,$this->limited);
       $count=$this->talentoModel->getAllCount($_SESSION["datos"][0]["id_directiva"],"INGRESO");
       $paginacion =  new Paginacion($count[0]["total"], $this->limited, $this->paginas, 1, "");
       $pag = $paginacion->createLink("pagination justify-content-center");
      //  echo var_dump($GetRegistros);
       
      /** GENERO LA RESPUESTA DEL FETCH DEL JS EN JSONG */
      $data = [
         "status" => "success",
         "icono" => Utils::assets('Img/panel/cpanel.svg'),
         "titulo" => "PANEL | Home",
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
