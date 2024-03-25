async function formularioEnvio(link,formulario) {
        
    // const formularioElement = document.querySelector(`#${formulario}`);

   
    const button = document.querySelector(`#${formulario}`);
    button.addEventListener('submit', async (event) => {
        btnEnvio=document.getElementById("BtnEnvio")
        btnEnvio.disabled= true;
        // Prevents the form from submitting
        event.preventDefault();
        const url = link;
        const method = "POST";
        const formData = new FormData(button);
        const fetchOptions = {
            method:"POST",
            body: formData,
            headers: {
                // "Content-Type": "application/json",
                "Authorization": "Bearer <token>",
      },
    };
        const response = await fetch(url, fetchOptions);
        
        const Data = await response.json();
        console.log(Data)
        if(Data.status == "error" || Data.status == "info"){
            btnEnvio.disabled=false;
        }
        Toast.fire({
            icon: await Data.status,
            title: await Data.titulo,
            text: Data.msg,
        })
        redirectUrl="";
        if(Data.status != 'error'){

            redirectUrl= await Data.url
        }
        // window.location.href = Data.data.retornar; 

    }, {once: true});
    return false;
}