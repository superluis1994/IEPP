<?php
// session_destroy();
// echo var_dump($_SESSION['datos']); 

?>
<!doctype html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$data["titulo"]?></title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= $data["icono"] ?>" type="image/x-icon">
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

<body class=" " data-bs -spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->
    <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center mb-3">
                                        <a href="#" class="navbar-brand d-flex align-items-center mb-3">
                                            <!--Logo start-->
                                            <div class="logo-main">
                                                <div class="logo-normal">
                                                    <img src="<?= $utils->assets('Img/auth/Logo_IEPP.webp'); ?>" class="text-primary" width="150" alt="Your Logo Description">
                                                </div>
                                            </div>
                                            <!--logo End-->
                                        </a>
                                    </div>
                                    <h2 class="mb-2 text-center">Iniciar Sesión</h2>
                                    <p class="text-center">Bienvenido al inicio de sesion de la <?= $_ENV["TITULO_APP"] ?>.</p>
                                    <form method="POST" id="formAccerder" autocomplete="off" data-fetch-url="<?php echo htmlspecialchars($data["url"]["form"]) ?>">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="Dui" class="form-label">DUI</label>
                                                    <input type="text" class="form-control" name="dui" id="dui" aria-describedby="Dui" placeholder="000000000" 
                                                    oninvalid="this.setCustomValidity('Por favor, ingresa un DUI de 9 dígitos sin guion')" oninput="this.setCustomValidity('')" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="password" class="form-label">Contraseña</label>
                                                    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="*********" 
                                                    oninvalid="this.setCustomValidity('Por favor, ingresa tu contraseña')" oninput="this.setCustomValidity('')" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-12 d-flex justify-content-center">
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" class="form-check-input" name="cookie" id="customCheck1" checked>
                                                    <label class="form-check-label" for="customCheck1">Recuerda las credenciales</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-12 d-flex justify-content-center mb-2">
                                                <a href="#" data-fetch-url="<?php echo htmlspecialchars($data["url"]["resetPassword"]) ?>">¿Ha olvidado tu contraseña?</a>
                                            </div>
                                            <div class="d-flex justify-content-center">
                                                <button type="submit"  id="BtnEnvio" class="btn btn-primary">
                                                Acceder
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sign-bg">
                        <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g opacity="0.05">
                                <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF" />
                                <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF" />
                                <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF" />
                                <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF" />
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                    <img src="<?= $utils->assets('Img/auth/01.png'); ?>" class="img-fluid gradient-main animated-scaleX" alt="images">
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
    <script src="<?= $utils->assets('Js/herramientas/formatearInput.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/Fetch/FetchForm.js'); ?>"></script>
    <script src="<?= $utils->assets('Js/sign-in/sign-in.js'); ?>"></script>


    <!-- AOS Animation Plugin-->

    <!-- App Script -->
    <script src="<?= $utils->assets('Js/hope-ui.js'); ?>" defer></script>
    <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.all.min.js'); ?>" defer></script>
    <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.js'); ?>" defer></script>
    <!-- <script src="<?= $utils->assets('Js/sweetalert/sweetalert2.js'); ?>" defer></script> -->



</body>

</html>