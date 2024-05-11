/** _ACCEDIENTO AL BTN BUSCAR */
// btn = document.getElementById("btn_search");
btn = document.querySelector("#btn_search");
/** _ACCEDIENTO AL INPUT _BUSCAR */
// inptSearch = document.getElementById("inputBuscar");
inptSearch = document.querySelector("#inputBuscar");
/** _TBODY DE LA TABLA EN LA CUAL SE VAN A CARGAR LA FILAS */
const tbody=document.querySelector("#contendioTb");
/** PAGINACION DE LA PAGINA */
const pagination = document.getElementById("paginacion");
/** CUANDO EL INPUT QUEDA VACIO CARGA LOS DATOS NUEVAMENTE */
inptSearch.addEventListener("keyup", (e) => {
  btn.id = "btn_search";
  
  if(e.target.value.length === 0 && btn.textContent ==="Cancelar"){
    btn.textContent = "Buscar";
    getSolicitud();
    // alert("Cancelar");
  }
});
/** VALIDA SI EL BTN ESTA BUSCANDO O NO ASI CARGA LOS DATOS */
document.getElementById("btn_search").addEventListener("click", (e) => {
  if (e.target.textContent === "Buscar" && inptSearch.value.length > 0) {
    e.target.textContent = "Cancelar";
    btn.id = "btn_cancelar";
  // getSolicitud(1,0)
  getSolicitud()
  
} else {
  inptSearch.value = "";
  e.target.textContent = "Buscar";
  e.target.id = "btn_search";
  getSolicitud()
  }
});

/** FUNCION QUE SE ENCARGA DE LAS PETICIONES CON EL BACKEND */
function getSolicitud(params=1, params2=0) {

    const Url = inptSearch.dataset.url
    const value = inptSearch.value
    const tipoBsq = inptSearch.dataset.codicion
    const paginacion = params
    const grupPaginacion = params2
 alert(Url + " "+ tipoBsq)
    const formData = new FormData();
    // if(params === "si"){
    //     formData.append("busqueda",value)
    // }
    if( btn.textContent == "Cancelar"){
     
        formData.append("busqueda",value)
    }
    formData.append("tipoBsq",tipoBsq)
    formData.append("paginacion",paginacion)
    formData.append("grupPaginacion",grupPaginacion)

// MENSAJE DE CARGANDO LOS DATOS
    tbody.innerHTML = `<tr>
        <td colspan="4" class="text-center">
            <div class="spinner-border text-secondary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
            <p>Cargando...</p> <!-- Texto debajo del spinner -->
        </td>
    </tr>`;
    pagination.innerHTML="";
    fetch(Url, {
            method: "POST",
            body: formData,
        })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
             tbody.innerHTML = "";
             pagination.innerHTML = "";
           // Itera sobre cada objeto en tu array de datos
           data.data.forEach(fila => {
             // Crea una nueva fila y celdas para los datos
             let tr = document.createElement('tr');
             tr.innerHTML = `<td class="text-bold-500">
                 <div class="d-flex align-items-center">
                   <h6 class="py-1">${fila.descripcion_tipo_solicitud}</h6>
                 </div>
               </td>
               <td class="text-bold-500">
                 <div class="d-flex align-items-center">
                   <h6>${fila.nombre} ${fila.apellido}</h6>
                 </div>
               </td>
               <td class="text-bold-500">
                 <div class="d-flex align-items-center">
                   <h6 class="text-info">${fila.fecha}</h6>
                 </div>
               </td>
               <td class="text-bold-500 col-4">
                 <div class="d-flex justify-content-center align-items-center">
                   <button type="button" class="btn btn-primary" onclick="modal(${fila.id_transferir_solicitud})" >
                     Administrar
                   </button>
                 </div>
               </td>`;
             // Añade la fila al cuerpo de la tabla
             tbody.appendChild(tr);
           });
           pagination.innerHTML = data.paginacion;
          //  paginacion.appendChild(data.paginacion);

        })
        .catch((error) => {
            console.error(error);
        });

  }