document.getElementById("dui").addEventListener("keyup", function (e) {
  const input = e.target.value.replace(/[^0-9-]/g, "").slice(0, 9); // Reemplazar caracteres no permitidos y limitar a 9 caracteres
  e.target.value = input;
});
document.getElementById("dui").addEventListener("blur", function (e) {
  input = e.target.value;
  if (input.length === 9 && e.key !== "Backspace") {
    e.target.value = input.slice(0, 8) + "-" + e.target.value[8];
  }
});
document.getElementById("dui").addEventListener("focus", function (e) {
  const input = e.target.value.replace("-", "").slice(0, 9); // Reemplazar caracteres no permitidos y limitar a 9 caracteres
  e.target.value = input;
});
//VARIABLE DE REDIRECCION
let redirectUrl="";

// Cuando tu formulario se envíe, crea un objeto FormData y usa sendForm para enviarlo
document.getElementById("formAccerder").addEventListener("submit", async (event) => {
    event.preventDefault(); // Previene el envío estándar del formulario

    const Url = event.target.getAttribute("data-fetch-url");
    const btnEnvio = document.getElementById("BtnEnvio");

    // Cambiar el estado del botón a "Cargando..."
    btnEnvio.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true">
                          </span> Verificando...`;
    btnEnvio.disabled = true;
    // Instancia de la clase con la URL base de tu API
    const api = new FetchAPI(Url);
    const formData = new FormData(event.target);
    try {
      const data = await api.sendForm(formData);
      if (data.status == "success") {
        setTimeout(function () {
          // Remover la clase btn-primary y agregar btn-success para cambiar el color a verde
          // Procesa la respuesta aquí
          btnEnvio.classList.remove("btn-primary");
          btnEnvio.classList.add("btn-success");
          // Cambiar el texto del botón a "Verificado" y eliminar el spinner
          btnEnvio.innerHTML = "Verificado";
          window.location.href = data.url;
        }, 2000);
        console.log("Respuesta del servidor:", data);
      } else {
        setTimeout(function () {
          btnEnvio.textContent = "Acceder";
          btnEnvio.disabled = false;
          Toast.fire({
            icon: data.status,
            title: data.msg
          });
          
          redirectUrl=data.url
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

