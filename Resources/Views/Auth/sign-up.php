
<!doctype html>
<html lang="es" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $header[1]; ?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= $utils->assets('Img/favicon.ico'); ?>" type="image/x-icon">
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/libs.min.css'); ?>" />
    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/hope-ui.min.css'); ?>" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/custom.min.css'); ?>" />
    <!-- Dark Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/dark.min.css'); ?>" />
    <!-- Customizer Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/customizer.min.css'); ?>" />
    <!-- RTL Css -->
    <link rel="stylesheet" href="<?= $utils->assets('Css/rtl.min.css'); ?>" />
</head>

<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0" >
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">            
               <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="<?= $utils->assets('Img/auth/05.png'); ?>" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
            <div class="col-md-6">               
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                        <div class="card-body">
                           <a href="#" class="navbar-brand d-flex align-items-center mb-3">
                              <!--Logo start-->
                              <!--logo End-->
                              
                              <!--Logo start-->
                              <div class="logo-main">
                                  <div class="logo-normal">
                                     
                                      <img src="<?= $utils->assets('Img/Logo.png'); ?>" class="text-primary icon-32"  alt="Your Logo Description">

                                  </div>
                                  <div class="logo-mini">
                                    
                                  </div>
                              </div>
                              <!--logo End-->
                              <h4 class="logo-title ms-3"><?=$_ENV["TITULO_APP"]?></h4>
                           </a>
                           <h2 class="mb-2 text-center">Inscribirse</h2>
                           <p class="text-center">Crea tu cuenta <?=$_ENV["TITULO_APP"]?>.</p>
                           <form method="POST" id="formRegistrar">
                              <div class="row">
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="full-name" class="form-label">Nombre completo</label>
                                       <input type="text" class="form-control" name="nombre" id="full-name" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="last-name" class="form-label">Apellidos</label>
                                       <input type="text" class="form-control" name="apellidos" id="last-name" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="email" class="form-label">Email</label>
                                       <input type="email" class="form-control" name="email" id="email" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="dui" class="form-label">DUI</label>
                                       <input type="text" class="form-control" name="dui" id="dui" placeholder=" " autocomplete="off" onpaste="return false;" draggable="return false;" >
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="password" class="form-label">Contraseña</label>
                                       <input type="password" class="form-control" name="contraseña" id="password" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="confirm-password" class="form-label">Re-Contraseña</label>
                                       <input type="text" class="form-control" id="confirm-password" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="phone" class="form-label">Telefono</label>
                                       <input type="text" class="form-control" name="telefono" id="phone" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-6">
                                    <div class="form-group">
                                       <label for="sucursal" class="form-label">Sucursal</label>
                                       <!-- <input type="text" class="form-control" id="sucursal" placeholder=" "> -->
                                       <select class="form-select mb-3 shadow-none" name="sucursal" id="sucursal">
                                             <option selected="">Seleccione uno..</option>
                                             <?php
                                             foreach ($data as $key => $value) {
                                              echo <<<HTML
                                                      <option value="{$value->id_sucursal}">{$value->nombre}</option>
                                              HTML;
                                             }
                                           ?>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 d-flex justify-content-center">
                                    <div class="form-check mb-3">
                                       <input type="checkbox" class="form-check-input" name="terminos" id="customCheck1">
                                       <label class="form-check-label" for="customCheck1">Estoy de acuerdo con los términos de uso</label>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex justify-content-center">
                                 <button type="submit" onclick="formularioEnvio('<?= $utils->url('/Auth/inscribirse');?>','formRegistrar')" id="BtnEnvio" class="btn btn-primary">Inscribirse</button>
                              </div>
                              <p class="mt-3 text-center">
                                Ya tienes una cuenta <a href="<?=$utils->url("/Auth/sign-in");?>" class="text-underline">Iniciar sesión</a>
                              </p>
                           </form>
                        </div>
                     </div>    
                  </div>
               </div>           
               <div class="sign-bg sign-bg-right">
                  <svg width="280" height="230" viewBox="0 0 421 359" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g opacity="0.05">
                        <rect x="-15.0845" y="154.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -15.0845 154.773)" fill="#3A57E8"/>
                        <rect x="149.47" y="319.328" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 149.47 319.328)" fill="#3A57E8"/>
                        <rect x="203.936" y="99.543" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 203.936 99.543)" fill="#3A57E8"/>
                        <rect x="204.316" y="-229.172" width="543" height="77.5714" rx="38.7857" transform="rotate(45 204.316 -229.172)" fill="#3A57E8"/>
                     </g>
                  </svg>
               </div>
            </div>   
         </div>
      </section>
      </div>
      

    <!-- Library Bundle Script -->
    <script src="<?= $utils->assets('Js/libs.min.js'); ?>"></script>

    <!-- External Library Bundle Script -->
    <script src="<?= $utils->assets('Js/external.min.js'); ?>"></script>

    <!-- Widgetchart Script -->
    <script src="<?= $utils->assets('Js/charts/widgetcharts.js'); ?>"></script>

    <!-- mapchart Script -->
    <script src="<?= $utils->assets('Js/charts/vectore-chart.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/charts/dashboard.js'); ?>"></script>

    <!-- fslightbox Script -->
    <script src="<?= $utils->assets('Js/plugins/fslightbox.js'); ?>"></script>

    <!-- Settings Script -->
    <script src="<?= $utils->assets('Js/plugins/setting.js'); ?>"></script>

    <!-- Slider-tab Script -->
    <script src="<?= $utils->assets('Js/plugins/slider-tabs.js'); ?>"></script>

    <!-- Form Wizard Script -->
    <script src="<?= $utils->assets('Js/plugins/form-wizard.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/formulario/formulario.js'); ?>"></script>
    <script src="<?=$utils->assets('Js/sign-in/sign-in.js'); ?>"></script>
    <!-- AOS Animation Plugin-->

    <!-- App Script -->
    <script src="<?= $utils->assets('Js/hope-ui.js'); ?>" defer></script>
    <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.all.min.js'); ?>" defer></script>
    <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.js'); ?>" defer></script>

</body> 

</html>