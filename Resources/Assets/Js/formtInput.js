document.getElementById("dui").addEventListener("keyup", function(e) {
    const input = e.target.value.replace(/[^0-9-]/g, "").slice(0, 9); // Reemplazar caracteres no permitidos y limitar a 9 caracteres
    e.target.value = input;
});
document.getElementById("dui").addEventListener("blur", function(e) {
    input = e.target.value;
    if (input.length === 9 && e.key !== "Backspace" ) {
        e.target.value = input.slice(0, 8) + "-" + e.target.value[8];
    }
});
document.getElementById("dui").addEventListener("focus", function(e) {
    const input = e.target.value.replace("-", "").slice(0, 9); // Reemplazar caracteres no permitidos y limitar a 9 caracteres
    e.target.value = input;
});