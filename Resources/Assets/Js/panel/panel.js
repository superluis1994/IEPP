//FUNCION ENCARGADA DE LA LOGICA PARA CERRAR LA SESSION
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
  