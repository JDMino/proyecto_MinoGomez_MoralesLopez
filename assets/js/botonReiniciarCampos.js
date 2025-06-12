document.addEventListener("DOMContentLoaded", function () {
        let btnLimpiar = document.querySelector(".limpiar-btn");
        let formulario = document.querySelector(".form-container");

        btnLimpiar.addEventListener("click", function () {
            formulario.reset(); // Esto limpia todos los campos del formulario
        });
 });
