<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="#">
  <title>IEPP  </title>

  <!-- plugins:css -->
  <?php include "inc/Link.php";?>

</head>

<body>
  <?php
      require_once "./controladores/VistaControlador.php";
      $IV = new VistaControlador();
      $vista = $IV->obtener_vistas_controlador();

//echo $vista;
if ($vista == "login" || $vista == "installer") {

    switch ($vista) {

        case "installer":
            if (file_exists("./vistas/contenido/" . $vista . "-url.php")) {
                require_once "./vistas/contenido/" . $vista . "-url.php";
            } else {
                // $vista="login";
                require_once "./vistas/contenido/login-url.php";
            }
            break;

        case "login":require_once "./vistas/contenido/" . $vista . "-url.php";
            break;
    }

    ?>
  <div class="container-scroller">

    <?php
} else {

    $ruta = explode("/", $_GET["url"]);
    if (isset($_SESSION['usuario']['tipo'])) {

        if ($_SESSION['usuario']['tipo'] == $ruta[0]) {
            switch ($ruta[0]) {
                case "admin":
                    include "admin/menu.php";
                    include "admin/menu_lateral.php";
                    include $vista;
                    break;

                case "usuario":
                    include "alumno/menu.php";
                    include "alumno/menu_lateral.php";
                    include $vista;
                    break;
            }

        } else {

            require_once "./vistas/contenido/login-url.php";
        }
    } else {
        require_once "./vistas/contenido/login-url.php";
    }

    ?>
  </div>
  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <?php
}
include "inc/footer.php";
include "inc/script.php";?>


</body>

</html>