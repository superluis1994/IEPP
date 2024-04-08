
// Instanciando la clase para el campo DUI
new FormateadorCampo("dui", "dui");

// Instanciando la clase para el campo de teléfono
new FormateadorCampo("phone", "telefono");


document.getElementById("confirm-password").addEventListener('keyup', function (e) {
  var confirmPassword = e.target.value;
  var password = document.getElementById('password').value;

  if (confirmPassword === password && confirmPassword !== "") {
      e.target.classList.add('is-valid');
      e.target.classList.remove('is-invalid'); // Asegúrate de remover 'is-invalid' si las contraseñas ahora coinciden
  } else {
      e.target.classList.remove('is-valid'); // Remueve 'is-valid' si las contraseñas no coinciden
      e.target.classList.add('is-invalid');
  }
});



  //VARIABLE DE REDIRECCION
  let redirectUrl="";

// Cuando tu formulario se envíe, crea un objeto FormData y usa sendForm para enviarlo
document.getElementById("formRegistrar").addEventListener("submit", async (event) => {
    event.preventDefault(); // Previene el envío estándar del formulario
   
 
    // Seleccionar el campo de confirmación de contraseña
    const confirmPasswordField = document.getElementById("confirm-password");

    // Verificar si tiene la clase 'is-valid'
    if (!confirmPasswordField.classList.contains('is-valid')) {
        // Mostrar un mensaje de error, ajusta esto según tu método de notificación
        alert('Las contraseñas no coinciden o no han sido validadas.'); // Ejemplo con alert, reemplázalo por tu método de notificación
        // Detener la ejecución si el campo no tiene la clase 'is-valid'
        return;
    }
    
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
      console.log(data);

      if (data.status == "success") {
        setTimeout(function () {
          // Remover la clase btn-primary y agregar btn-success para cambiar el color a verde
          // Procesa la respuesta aquí
          btnEnvio.classList.remove("btn-primary");
          btnEnvio.classList.add("btn-success");
          // Cambiar el texto del botón a "Verificado" y eliminar el spinner
          btnEnvio.innerHTML = "Registrado";
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

