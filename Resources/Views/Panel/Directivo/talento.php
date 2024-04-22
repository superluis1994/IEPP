<!-- <style>
    .skeleton {
        animation: skeleton-loading 1.5s infinite linear;
        background: linear-gradient(90deg, #f0f0f0, #e0e0e0, #f0f0f0);
        background-size: 200% 100%;
        opacity: 0.7;
    }

    @keyframes skeleton-loading {
        0% {
            background-position: 200% 0;
        }

        100% {
            background-position: -200% 0;
        }
    }

    .skeleton-text {
        color: transparent !important;
        /* Hace el texto transparente */
    }

    .skeleton-label {
        color: transparent !important;
        /* Asegura que el texto se vuelva transparente */
        animation: skeleton-loading 1.5s infinite linear;
        background: linear-gradient(90deg, #f0f0f0, #e0e0e0, #f0f0f0);
        background-size: 200% 100%;
        opacity: 0.7;
    }

    .skeleton-img {
        filter: blur(8px);
        /* Opcional: Puedes ajustar esto para que se adapte mejor a tu diseño */
        width: 350px;
        /* Establece el ancho deseado para la imagen */
        height: 370px;
        /* Mantiene la relación de aspecto de la imagen */


    }

    .card img {
        width: 350px;
        /* Establece el ancho deseado para la imagen */
        height: 370px;
        /* Establece la altura deseada para la imagen */
        object-fit: cover;
        /* La imagen cubrirá el área disponible, se cortará si es necesario */
        display: block;
        /* Elimina cualquier espacio extra debajo de la imagen */
    }
    .label-loading {
  color: transparent;
}


/* Aplicar estilos sticky solo en pantallas pequeñas */
@media (max-width: 768px) {
    th:first-child, td:first-child {
        position: sticky;
        color: aliceblue;
        left: 0;
        background-color: rgb(52, 70, 96); /* o el color de fondo de tu tabla */
        z-index: 100;
    }
    
    
      /* Asegúrate de que la tabla se pueda desplazar horizontalmente */
      .table-fixed {
        overflow-x: auto;
        display: block;
      }
    /* Estilos para los encabezados y celdas de la tabla */
    .table-fixed th,
    .table-fixed td {
        border: 1px solid #ddd; /* Cambia #ddd al color de borde que prefieras */
     padding: 8px; /* Ajusta el padding según necesites */
   }
   /* Asegurar que la primera columna tenga un ancho fijo y el texto se ajuste */
   .table-fixed thead th:first-child, 
   .table-fixed tbody td:first-child {
     width: 150px; /* Establece el ancho que desees para la primera columna */
     min-width: 150px; /* Establece un ancho mínimo igual al ancho fijo */
     max-width: 150px; /* Establece un ancho máximo igual al ancho fijo */
     white-space: normal; /* Permite que el texto se ajuste en la celda */
     word-wrap: break-word; /* Permite que las palabras largas se rompan y pasen a la siguiente línea */
   }
   .text-mobile-white {
      color: #fff !important; /* Agrega !important para asegurar que sobreescribe otras clases */
    }
    .text-th{
        background-color: rgb(52, 70, 96); 
    }
  }


  
</style> -->
<div class="conatiner-fluid content-inner mt-n5 py-0 ">
    <div class="row mt-lg-3 mt-3 ">
        <div class="col-md-12 col-lg-12 mt-lg-5 ">
            <div class="row row-cols-1">
                <div class="overflow-hidden d-slider1 ">
                    <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline lista ">
                        <li class='swiper-slide card card-slide active-card' data-aos="fade-up" data-aos-delay="700">
                            <a href="">
                                <div class="card-body">

                                    <div class="progress-widget">
                                        <div id="circle-progress-04" class="text-center circle-progress-01 circle-progress circle-progress-info" data-min-value="0" data-max-value="100" data-value="100" data-type="percent" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="60">
                                            <svg class="card-slie-arrow icon-24" width="24px" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z"></path>
                                            </svg>
                                        </div>
                                        <div class="progress-detail">
                                            <p class="mb-2">Talento Entrada</p>
                                            <h4 class="counter" style="visibility: visible;">2.6</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="700">
                            <a href="">
                                <div class="card-body">
                                    <div class="progress-widget">
                                        <div id="circle-progress-01" class="text-center circle-progress-01 circle-progress circle-progress-primary" data-min-value="0" data-max-value="100" data-value="90" data-type="percent">
                                            <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                                <path fill="currentColor" d="M5,17.59L15.59,7H9V5H19V15H17V8.41L6.41,19L5,17.59Z" />
                                            </svg>
                                        </div>

                                        <div class="progress-detail">
                                            <p class="mb-2">Talento Salida</p>
                                            <h4 class="counter">
                                                2.6
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="swiper-button swiper-button-next"></div>
                    <div class="swiper-button swiper-button-prev"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                <div class="card-body p-0 position-relative">
                    <div class="table-responsive">
                        <table id="basic-table" class="table table-striped mb-0 table-fixed" role="grid">
                            <thead>
                                <tr>
                                    <th class="text-th">REALIZADA</th>
                                    <th>CANTIDAD</th>
                                    <th>FECHA REGISTRO</th>
                                    <th class="col-4">
                                        <div class="input-group search-input">
                                            <input type="search" class="form-control" id="inputBuscar" data-url="" placeholder="Buscar...">
                                            <button class="btn btn-outline-primary btn-accion" type="button" id="btn_search">Buscar</button>
                                        </div>
                                    </th>

                                </tr>
                            </thead>

                            <tbody id="contendioTb" data-Url="">
        
                                <?php
                                foreach ($data["data"] as $key => $value){

                                    echo sprintf('<tr>
                                    <td class="text-bold-500 ">
                                        <div class="d-flex align-items-center">
                                            <h6 class="py-1  text-mobile-white">%s</h6>
                                        </div>
                                    </td>
                                    <td class="text-bold-500">
                                        <div class="d-flex align-items-center">
                                            <h6>$%s</h6>
                                        </div>
                                    </td>   
                                    <td class="text-bold-500">
                                        <div class="d-flex align-items-center">
                                            <h6>%s</h6>
                                        </div>
                                    </td>   
                                    <td class="text-bold-500 col-4">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <button type="button" class="btn btn-primary" data-id="%s">
                                                Modificar
                                            </button>
                                        </div>
                                    </td>
                                </tr>',
                                     $value["realizado"],
                                     $value["cantidad"],
                                     $value["fecha"],
                                     $value["id"]
                                );
                                }

                                ?>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="bd-example mt-2 pagination justify-content-center align-items-center">
                <nav aria-label="Standard pagination example" id="paginacion">
                    <?= $data["paginacion"]; ?>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<!-- <style>

legend.scheduler-border {
    font-size: 1.2em !important;
    font-weight: bold !important;
    text-align: left !important;
}


.overlay {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    transition: .5s ease;
    background-color: rgba(0, 0, 0, 0.5);
}

.image-container:hover .overlay {
    opacity: 1;
}

.view-btn {
    color: white;
    font-size: 20px; /* Tamaño del icono de la lupa */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
}



















/* Estilos específicos para el nuevo modal */
.mi-close {
  position: absolute;
  top: 1rem;
  right: 1rem;
  z-index: 1050;
  border-radius: 50%; /* Circular completo */
  background: white; /* Fondo azul */
  color: black; /* 'X' de color blanco */
  width: 40px; /* Tamaño del círculo */
  height: 40px;
  display: flex;
  align-items: center; /* Centrar 'X' verticalmente */
  justify-content: center; /* Centrar 'X' horizontalmente */
  cursor: pointer;
  border: none; /* Sin bordes */
  font-size: 1.5rem; /* Tamaño del icono 'X' */
  line-height: 1; /* Asegurar que el 'X' no tenga espacio extra arriba/abajo */
  padding: 0; /* Eliminar padding para que 'X' no desplace el botón */
}


.mi-modal-dialog {
  margin: 0;
  margin-right: auto;
  margin-left: auto;
  width: 100%;
  height: 100vh; /* Usar el 100% de la altura de la pantalla */
  max-width: none; /* Para que no tenga un ancho máximo */
}

.mi-modal-content {
  height: 100vh; /* Usar el 100% de la altura de la pantalla */
  background: rgba(0,0,0,0.85); /* Fondo semi-transparente */
  border: none; /* Sin borde */
  border-radius: 0; /* Sin bordes redondeados */
  display: flex; /* Usar flexbox para centrar la imagen */
  align-items: center; /* Centrar verticalmente */
  justify-content: center; /* Centrar horizontalmente */
}

.mi-modal-body {
  padding: 0; /* Sin padding para que la imagen pueda ser más grande */
}

.mi-modal-img {
  max-height: 90vh; /* Máximo altura de la imagen */
  max-width: 100%; /* Máximo ancho de la imagen */
}


</style> -->

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title scheduler-border" id="staticBackdropLabel  ">ADM SOLICITUD</h5>
                <button type="button" class="btn-close" id="cerrarModal" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-3 m-2">
                        <div class="card">
                            <!-- <img src="" class="img-fluid rounded-start" alt="...">
                            <button class="btn-ver-completa" style="display: none;">Completa</button> -->
                            <div class="image-container">
                                <img src="" alt="Descripción de la imagen" class="image img-fluid rounded-start"  style="cursor:pointer">
                                <div class="overlay" id="clikImagen" data-toggle="modal" data-target="#miImageModal">
                                    <span href=""  class="view-btn">
                                    <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">                                <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z" fill="currentColor"></path>                                <path d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z" fill="currentColor"></path>                                </svg>                            
                                    FULL
                                </span>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Nombre del solicitante</label>
                                    <input type="text" class="form-control" name="nombre" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Apellido del solicitante</label>
                                    <input type="text" class="form-control" name="apellido" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold fw-bold">Tipo de solicitud</label>
                                    <input type="text" class="form-control" name="descripcion_tipo_solicitud">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Fecha de solicitud</label>
                                    <input type="text" class="form-control" name="fecha">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label fw-bold">Hora de solicitud</label>
                                    <input type="text" class="form-control" name="uname">
                                </div>
                            </div> -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="exampleFormControlTextarea1">Direccion</label>
                                <textarea class="form-control" name="direccion" id="exampleFormControlTextarea1" rows="5" style="height: 70px;"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold" for="exampleFormControlTextarea1">Descripcion</label>
                                <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="5" style="height: 70px;"></textarea>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group mt-2">
                                    <label class="form-label fw-bold">Estado Solicitud</label>
                                    <select class="form-select mb-3 shadow-none">
                                        <option selected="">Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label class="form-label fw-bold" for="exampleFormControlTextarea1">Comentario</label>
                                <textarea class="form-control" name="comentario" id="exampleFormControlTextarea1" rows="5" style="height: 70px;"></textarea>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary" data-Url="'<?php echo $_SESSION['home'] ?>/sorto'">Actualizar</button>
                                
                            </div> -->
                            
                            <form method="POST" id="updateEstadoSoli" data-Url="<?=$datos2["urlActuSolicitud"];?>">
                        <div class="row mt-2 form-label" style=" border: 1px groove #ddd !important;">
                            <legend class="scheduler-border">Avance de la Solicitud</legend>

                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                    <label class=" fw-bold">Estado Solicitud</label>
                                    <select class="form-select mb-3 shadow-none form-control form-label" name="status">
                                        <option selected>Seleccione ....</option>
                                        <?php
                                        // echo var_dump($datos2["select"]);
                                        foreach ($datos2["select"] as $key => $value) {
                                            @$html.=sprintf('<option value="%s">%s</option>',
                                            $value["id_estado"],
                                            $value["descripcion"]
                                        );
                                        }
                                       echo @$html;
                                        ?>
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold" for="exampleFormControlTextarea1">Comentario</label>
                                    <textarea class="form-control" name="comentario" id="exampleFormControlTextarea1" rows="5" style="height: 70px;"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <!-- Asegúrate de reemplazar el PHP por el valor real que necesitas cuando lo renderices -->
                                    <button type="submit" class="btn btn-primary mb-2 " >Actualizar</button>
                                </div>
                            </div>
                        </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
                <div class="form-group" >
                    <label class="form-label label-left" style="text-align: left;">Fecha de asignacion</label>
                </div>
                <button type="button" class="btn btn-primary" data-Url="'<?php echo $_SESSION['home'] ?>/sorto'">Actualizar</button>
            </div> -->

            <div class="modal-footer justify-content-between">
                <div class="form-group mb-0"> <!-- mb-0 asegura que no haya un margen en la parte inferior -->
                    <label class="form-label" id="fecha_envio">Fecha de asignacion</label>
                </div>
                <!-- <button type="button" class="btn btn-primary" data-Url="'<?php echo $_SESSION['home'] ?>/sorto'">Actualizar</button> -->
            </div>
            
        </div>
    </div>
</div>







<!-- La imagen que al hacer clic abrirá el modal -->
<!-- <div class="image-container">
    <img src="ruta_a_tu_imagen_pequeña.jpg" alt="Descripción de la imagen" class="img-thumbnail" style="cursor:pointer" data-toggle="modal" data-target="#imagenModal">
  </div> -->
  
<!-- Imagen que al hacer clic abrirá el modal -->

<!-- Modal para mostrar la imagen -->
<div class="modal fade" id="miImageModal" tabindex="-1" aria-labelledby="miImageModalLabel" aria-hidden="true">
  <div class="modal-dialog mi-modal-dialog modal-xl" role="document">
    <div class="modal-content mi-modal-content">
      <div class="modal-body mi-modal-body">
        <!-- Botón para cerrar el modal -->
        <button type="button" class="close mi-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- Imagen en pantalla completa -->
        <img src="" class="img-fluid mi-modal-img" id="fullImg" alt="Imagen descriptiva">
      </div>
    </div>
  </div>
</div>

  
























<!-- Modal -->
<!-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">ADM SOLICITUD</h5>
                <button type="button" class="btn-close" data-dismiss="modal" id="cerrarModal" data-cerra="cerrar" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row"> -->
<!-- <div class="col-4">
                        <div class="card">
                            <img src="" alt="...">
                        </div>
                    </div> -->
<!-- <div class="col-4">
                        <div class="card">
                            <img src="" class="img-fluid rounded-start" alt="...">
                            <button class="btn-ver-completa" style="display: none;">Completa</button>
                        </div>
                        </div>

                    <div class="col-8">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="form-group">
                                    <label class="form-label">Tipo de solicitud</label>
                                    <input type="text" class="form-control" name="descripcion_tipo_solicitud" >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Nombre del solicitante</label>
                                    <input type="text" class="form-control" name="nombre" >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Apellido del solicitante</label>
                                    <input type="text" class="form-control" name="apellido" >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Fecha de solicitud</label>
                                    <input type="text" class="form-control" name="fecha_envio" >
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="form-label">Hora de solicitud</label>
                                    <input type="text" class="form-control" name="uname">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer"> -->
<!-- <button type="button" class="btn btn-secondary"  data-cerra="" >Cancelar</button> -->
<!-- <button type="button" class="btn btn-primary" data-Url="'<?php echo $_SESSION['home'] ?>/sorto'">Actualizar</button>
            </div>
        </div>
    </div>
</div> -->
<!-- /.container-fluid -->
<!-- <script src="<?php echo $_SESSION['home'] ?>assets/js/solicitud.js"></script> -->


<script>
    //     document.querySelectorAll('#clikImagen').forEach(function(btn) {
    //     btn.addEventListener('click', function(e) {
    //        alert("click")
    //         // var imageSrc = this.getAttribute('href');
    //         // Aquí puedes abrir un modal o hacer cualquier otra cosa
    //         console.log('Abrir la imagen en modal: ' + imageSrc);
    //     });
    // });
    document.getElementById("clikImagen").addEventListener("click", function(){
             
    })
    </script>
    