
class FormateadorCampo {
    constructor(idCampo, formato) {
      this.campo = document.getElementById(idCampo);
      this.formato = formato; // 'dui' o 'telefono'
      this.agregarEventListeners();
    }
  
    agregarEventListeners() {
      this.campo.addEventListener("keyup", (e) => this.enKeyup(e));
      this.campo.addEventListener("blur", (e) => this.enBlur(e));
      this.campo.addEventListener("focus", (e) => this.enFocus(e));
    }
  
    enKeyup(e) {
      let input = e.target.value;
      if (this.formato === 'dui') {
        input = input.replace(/[^0-9-]/g, "").slice(0, 9);
      } else if (this.formato === 'telefono') {
        input = input.replace(/[^0-9]/g, "").slice(0, 8);
        if (input.length > 4) {
          input = input.slice(0, 4) + "-" + input.slice(4);
        }
      }
      e.target.value = input;
    }
  
    enBlur(e) {
      let input = e.target.value.replace(/[^0-9-]/g, "");
      if (this.formato === 'dui' && input.length === 9 && e.key !== "Backspace") {
        e.target.value = input.slice(0, 8) + "-" + input[8];
      } else if (this.formato === 'telefono' && input.length === 8 && !input.includes("-")) {
        e.target.value = input.slice(0, 4) + "-" + input.slice(4);
      }
    }
  
    enFocus(e) {
      const input = e.target.value.replace("-", "");
      e.target.value = input;
    }
  }
  // window.FormateadorCampo = FormateadorCampo;
  // // Instanciando la clase para el campo DUI
  // new FormateadorCampo("dui", "dui");
  
  // // Instanciando la clase para el campo de teléfono
  // new FormateadorCampo("phone", "telefono");
  











  