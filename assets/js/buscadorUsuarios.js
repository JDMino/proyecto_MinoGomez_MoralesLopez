document.addEventListener("DOMContentLoaded", function () {
    let inputBuscar = document.getElementById("buscarUsuario");
    let filas = document.querySelectorAll("#tablaUsuarios tr");

    if (!inputBuscar || filas.length === 0) {
        console.warn("No se encontró el buscador o la tabla está vacía.");
        return;
    }

    inputBuscar.addEventListener("keyup", function () {
        let filtro = this.value.toLowerCase().trim(); // Normalización del texto ingresado

        filas.forEach((fila) => {
            let columnas = fila.cells; // Obtiene todas las celdas de la fila

            if (!columnas || columnas.length === 0) return;

            let id = columnas[0]?.textContent.toLowerCase() || "";
            let nombre = columnas[1]?.textContent.toLowerCase() || "";
            let apellido = columnas[2]?.textContent.toLowerCase() || "";
            let usuario = columnas[3]?.textContent.toLowerCase() || "";
            let email = columnas[4]?.textContent.toLowerCase() || "";
            let perfil = columnas[5]?.textContent.toLowerCase() || "";

            // Filtra por cualquier campo relevante
            if (id.includes(filtro) || nombre.includes(filtro) || apellido.includes(filtro) || usuario.includes(filtro) || email.includes(filtro) || perfil.includes(filtro)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    });
});