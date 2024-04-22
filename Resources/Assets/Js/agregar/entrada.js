
// Cuando tu formulario se envíe, crea un objeto FormData y usa sendForm para enviarlo
document.getElementById("formEntrada").addEventListener("submit", async (event) => {
    event.preventDefault(); // Previene el envío estándar del formulario

    const Url = event.target.getAttribute("data-fetch-url");

    document.getElementById('loadingScreen').style.display = 'flex';
    // // Cambiar el estado del botón a "Cargando..."

    // Instancia de la clase con la URL base de tu API
    const api = new FetchAPI(Url);
    const formData = new FormData(event.target);
    try {
      const data = await api.sendForm(formData);
      if (data.status == "success") {
        setTimeout(function () {
            document.getElementById('loadingScreen').style.display = 'none';
            event.target.reset();
            document.getElementById('cerrarbtn').click();
            Toast.fire({
              icon: data.status,
              title: data.msg
            });
        }, 2000);
        console.log("Respuesta del servidor:", data);
      } else {
        setTimeout(function () {
            document.getElementById('loadingScreen').style.display = 'none';
          Toast.fire({
            icon: data.status,
            title: data.msg
          });
          
        //   redirectUrl=data.url
        }, 2000);
      }

      // Restablecer el botón a su estado original después de recibir la respuesta
    } catch (error) {
      console.error("Error al enviar el formulario:", error);
      // Maneja el error aquí
      // Asegurarse de que el botón se restablezca incluso si hay un error
      btnEnvio.textContent = "Acceder";
      btnEnvio.disabled = false;
    }
  });