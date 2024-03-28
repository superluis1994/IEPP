// document.getElementById("Salir").addEventListener("click", async function(){
//     var url = this.getAttribute("data-url"); 
//    const respoder =await Swal.fire({
//         title: "Quieres salir del sistema?",
//         text: "Al salir del sistema tendras que iniciar sesion nuevamente!",
//         icon: "warning",
//         showCancelButton: false, // No mostrar el botón cancelar
//         showDenyButton: true, // Mostrar un botón adicional
//         denyButtonText: `No, Salir`, // Texto del botón adicional
//         confirmButtonColor: "#3085d6",
//         confirmButtonText: "Si, Salir!"
//       }).then((result) => {
//         if (result.isConfirmed) {
//             //aqui va la peticion fetch
//             const api = new FetchAPI(url);
//             const formData = new FormData();
//             try {
//                 const feth = await api.sendForm(formData);
//             } catch (error) {
//                 console.error("Error optenido:", error);
//             }

//         //   Swal.fire({
//         //     title: "Deleted!",
//         //     text: "Your file has been deleted.",
//         //     icon: "success"
//         //   });

//         }
//       });
 
// })
document.getElementById("Salir").addEventListener("click", async function() {
    var url = this.getAttribute("data-url");
    
    const result = await Swal.fire({
      title: "¿Quieres salir del sistema?",
      text: "Al salir del sistema tendrás que iniciar sesión nuevamente!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, Salir!",
      cancelButtonText: "No, cancelar"
    });
  
    if (result.isConfirmed) {
      // Aquí va la petición fetch
      try {
        const api = new FetchAPI(url);
        const response = await api.sendForm(new FormData()); // Si no hay datos para enviar, simplemente puedes pasar un objeto FormData vacío o modificar la clase FetchAPI para no requerir este parámetro.
        Swal.fire({
            title: response.title,
            text: "Has salido del sistema correctamente " + response.msg,
            icon: response.status,
            willClose: () => {
                if(response.url !== ""){
                window.location.href = response.url;  // URL de redirección
            }
            }
          });
          
          
        console.log(response)
        // Redirigir o realizar alguna acción después de cerrar sesión
      } catch (error) {
        console.error("Error obtenido:", error);
        // Manejar el error o mostrar un mensaje al usuario
      }
    }
  });
  



// alert();