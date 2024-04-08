<div class="conatiner-fluid content-inner  mt-n5 py-0 ">
   <div class="row mt-lg-3">
      <div class="col-md-12 col-lg-12 mt-lg-5">
         <div class="row row-cols-1">
            <div class="overflow-hidden d-slider1 ">
               <ul class="p-0 m-0 mb-2 swiper-wrapper list-inline">
                  <?php
                  foreach ($data["data"] as $indice => $transaccion) {
                     $delay = 700 + ($indice + 1) * 100; // Incrementamos el delay para la animación
                     $titulo = $transaccion["titulo"];
                     $balance = $transaccion["balance_neto"] === "Sin dinero" ? $transaccion["balance_neto"] : "$" . $transaccion["balance_neto"];
                     $colorClase = $transaccion["balance_neto"] === "Sin dinero" ? "circle-progress-danger" : "circle-progress-info"; // Cambiar clase de color según condición

                     echo <<<HTML
                     <li class="swiper-slide card card-slide" data-aos="fade-up" data-aos-delay="$delay">
                        <div class="card-body">
                           <div class="progress-widget">
                                 <div id="circle-progress-$indice" class="text-center circle-progress-01 circle-progress $colorClase" data-min-value="0" data-max-value="100" data-value="80" data-type="percent">
                                    <svg class="card-slie-arrow icon-24" width="24" viewBox="0 0 24 24">
                                       <path fill="currentColor" d="M19,6.41L17.59,5L7,15.59V9H5V19H15V17H8.41L19,6.41Z" />
                                    </svg>
                                 </div>
                                 <div class="progress-detail">
                                    <p class="mb-2">$titulo</p>
                                    <h5 class="counter text-muted">$balance</h5>
                                 </div>
                           </div>
                        </div>
                     </li>
                  HTML;
                  }

                  ?>

               </ul>
               <div class="swiper-button swiper-button-next"></div>
               <div class="swiper-button swiper-button-prev"></div>
            </div>
         </div>
      </div>
      <style>
         /* Estilos generales de la tarjeta */
         .card {
            position: relative;
            /* Tus otros estilos de .card van aquí */
         }

         /* Estilos para el ícono en la cabecera de la tarjeta */
         .card-header .icon-wrapper {
            position: absolute;
            top: -1rem;
            /* Ajusta esta medida para que el círculo sobresalga adecuadamente */
            left: 50%;
            transform: translateX(-50%);
            width: 3rem;
            /* Tamaño del círculo */
            height: 3rem;
            /* Tamaño del círculo */
            background-color: #fff;
            /* Color de fondo del círculo */
            border: 3px solid #ddd;
            /* Grosor y color del borde del círculo */
            border-radius: 50%;
            /* Redondea el borde para formar un círculo */
            display: flex;
            align-items: center;
            justify-content: center;
         }

         /* Estilos para el ícono dentro del círculo */
         .icon-wrapper i {
            color: #666;
            /* Color del ícono */
            /* Ajusta el tamaño del ícono si es necesario */
         }

         /* Ajustes adicionales para la cabecera de la tarjeta para hacer espacio para el ícono */
         .card-header {
            padding-top: 2rem;
            /* Asegúrate de que haya suficiente espacio para el círculo en la parte superior */
            /* Tus otros estilos de .card-header van aquí */
         }

         /* Estilos opcionales para añadir una sombra al círculo del ícono */
         .icon-wrapper {
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
         }

         .card-menu {
            min-height: 170px;
            /* Ajusta este valor al que prefieras */
            /* Mantén las demás propiedades existentes */
         }


         .card-container {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            gap: 15px;
            /* Espacio entre las tarjetas, ajusta según tu diseño */
         }

         .card-container .card {
            flex: 0 0 auto;
            /* Evita que las tarjetas se estiren */
         }
      </style>


      <div class="container mt-2 p-4 d-lg-none" style="max-height: 450px; overflow-y: auto; ">
         <div class="row">
            <!-- Card 1 -->
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu ">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Add Entradas</h5>
                     <p class="card-text ">Regitrar ventas, talento, ofrenda</p>
                  </div>
               </div>
            </div>
            <!-- ...other cards... -->
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Add<br> Salida</h5>
                     <p class="card-text text-center">Regitrar ventas, talento, ofrenda</p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Asistencia</h5>
                     <p class="card-text ">Lista de jovenes </p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Ahorro </h5>
                     <p class="card-text text-justify ">Ahorros de los jovenes </p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Reporte Financiero</h5>
                     <p class="card-text ">Reporte de ventas, talento, ofrenda </p>
                  </div>
               </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
               <div class="card mb-4 shadow-sm card-menu">
                  <div class="card-header bg-primary text-white">
                     <div class="icon-wrapper">
                        <i class="fa-solid fa-credit-card fa-lg"></i>
                     </div>
                  </div>
                  <div class="card-body">
                     <h5 class="card-title text-center">Reporte Asistencia</h5>
                     <p class="card-text ">Reporte de asistencia </p>
                  </div>
               </div>
            </div>
         </div>
      </div>








      <div class="col-md-12 col-lg-8">
         <div class="row">
            <div class="col-md-12 col-lg-12">
               <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                  <div class="flex-wrap card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="mb-2 card-title">Enterprise Clients</h4>
                        <p class="mb-0">
                           <svg class="me-2 text-primary icon-24" width="24" viewBox="0 0 24 24">
                              <path fill="currentColor" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                           </svg>
                           15 new acquired this month
                        </p>
                     </div>
                  </div>
                  <div class="p-0 card-body">
                     <div class="mt-4 table-responsive">
                        <table id="basic-table" class="table mb-0 table-striped" role="grid">
                           <thead>
                              <tr>
                                 <th>COMPANIES</th>
                                 <th>CONTACTS</th>
                                 <th>ORDER</th>
                                 <th>COMPLETION</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <img class="rounded bg-soft-primary img-fluid avatar-40 me-3" src="../assets/images/shapes/01.png" alt="profile">
                                       <h6>Addidis Sportwear</h6>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="iq-media-group iq-media-group-1">
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                       </a>
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                       </a>
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>$14,000</td>
                                 <td>
                                    <div class="mb-2 d-flex align-items-center">
                                       <h6>60%</h6>
                                    </div>
                                    <div class="shadow-none progress bg-soft-primary w-100" style="height: 4px">
                                       <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <img class="rounded bg-soft-primary img-fluid avatar-40 me-3" src="../assets/images/shapes/05.png" alt="profile">
                                       <h6>Netflixer Platforms</h6>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="iq-media-group iq-media-group-1">
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                       </a>
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>$30,000</td>
                                 <td>
                                    <div class="mb-2 d-flex align-items-center">
                                       <h6>25%</h6>
                                    </div>
                                    <div class="shadow-none progress bg-soft-primary w-100" style="height: 4px">
                                       <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <img class="rounded bg-soft-primary img-fluid avatar-40 me-3" src="../assets/images/shapes/02.png" alt="profile">
                                       <h6>Shopifi Stores</h6>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="iq-media-group iq-media-group-1">
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                       </a>
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">TP</div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>$8,500</td>
                                 <td>
                                    <div class="mb-2 d-flex align-items-center">
                                       <h6>100%</h6>
                                    </div>
                                    <div class="shadow-none progress bg-soft-success w-100" style="height: 4px">
                                       <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <img class="rounded bg-soft-primary img-fluid avatar-40 me-3" src="../assets/images/shapes/03.png" alt="profile">
                                       <h6>Bootstrap Technologies</h6>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="iq-media-group iq-media-group-1">
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">SP</div>
                                       </a>
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">PP</div>
                                       </a>
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                       </a>
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">TP</div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>$20,500</td>
                                 <td>
                                    <div class="mb-2 d-flex align-items-center">
                                       <h6>100%</h6>
                                    </div>
                                    <div class="shadow-none progress bg-soft-success w-100" style="height: 4px">
                                       <div class="progress-bar bg-success" data-toggle="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </td>
                              </tr>
                              <tr>
                                 <td>
                                    <div class="d-flex align-items-center">
                                       <img class="rounded bg-soft-primary img-fluid avatar-40 me-3" src="../assets/images/shapes/04.png" alt="profile">
                                       <h6>Community First</h6>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="iq-media-group iq-media-group-1">
                                       <a href="#" class="iq-media-1">
                                          <div class="icon iq-icon-box-3 rounded-pill">MM</div>
                                       </a>
                                    </div>
                                 </td>
                                 <td>$9,800</td>
                                 <td>
                                    <div class="mb-2 d-flex align-items-center">
                                       <h6>75%</h6>
                                    </div>
                                    <div class="shadow-none progress bg-soft-primary w-100" style="height: 4px">
                                       <div class="progress-bar bg-primary" data-toggle="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-12 col-lg-4">
         <div class="row">
            <div class="col-md-12 col-lg-12">
               <div class="card" data-aos="fade-up" data-aos-delay="600">
                  <div class="flex-wrap card-header d-flex justify-content-between">
                     <div class="header-title">
                        <h4 class="mb-2 card-title">Actidades</h4>
                        <p class="mb-0">
                           <svg class="me-2 icon-24" width="24" height="24" viewBox="0 0 24 24">
                              <path fill="#17904b" d="M13,20H11V8L5.5,13.5L4.08,12.08L12,4.16L19.92,12.08L18.5,13.5L13,8V20Z" />
                           </svg>
                           16% this month
                        </p>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="mb-2  d-flex profile-media align-items-top">
                        <div class="mt-1 profile-dots-pills border-primary"></div>
                        <div class="ms-4">
                           <h6 class="mb-1 ">$2400, Purchase</h6>
                           <span class="mb-0">11 JUL 8:10 PM</span>
                        </div>
                     </div>
                     <div class="mb-2  d-flex profile-media align-items-top">
                        <div class="mt-1 profile-dots-pills border-primary"></div>
                        <div class="ms-4">
                           <h6 class="mb-1 ">New order #8744152</h6>
                           <span class="mb-0">11 JUL 11 PM</span>
                        </div>
                     </div>
                     <div class="mb-2  d-flex profile-media align-items-top">
                        <div class="mt-1 profile-dots-pills border-primary"></div>
                        <div class="ms-4">
                           <h6 class="mb-1 ">Affiliate Payout</h6>
                           <span class="mb-0">11 JUL 7:64 PM</span>
                        </div>
                     </div>
                     <div class="mb-2  d-flex profile-media align-items-top">
                        <div class="mt-1 profile-dots-pills border-primary"></div>
                        <div class="ms-4">
                           <h6 class="mb-1 ">New user added</h6>
                           <span class="mb-0">11 JUL 1:21 AM</span>
                        </div>
                     </div>
                     <div class="mb-1  d-flex profile-media align-items-top">
                        <div class="mt-1 profile-dots-pills border-primary"></div>
                        <div class="ms-4">
                           <h6 class="mb-1 ">Product added</h6>
                           <span class="mb-0">11 JUL 4:50 AM</span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>



   </div>
</div>